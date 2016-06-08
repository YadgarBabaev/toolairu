<?php

namespace RleeCMS\ShopBundle\Controller\Site;

use Doctrine\ORM\QueryBuilder;
use RleeCMS\ShopBundle\Core\Shop;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Cart controller.
 * @Route("/cart")
 */
class CartController extends Controller
{
    /**
     * @Template()
     * Route("/", name="site_cart")
     */
    public function indexAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $cart = unserialize($request->cookies->get('cart', serialize(array())));
        $translator = $this->get('translator');
        $em = $this->getDoctrine()->getManager();
        return array(
            'cart' => $cart,
        );
    }

    /**
     * @Route("/", name="site_cart")
     * @Template()
     */
    public function cartAction(Request $request)
    {
        $cart = unserialize($request->cookies->get('cart', serialize(array())));
        $qb = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->createQueryBuilder('p');

        $products = $qb
            ->where('p.id IN (:id)')
            ->setParameter('id', $cart)
            ->getQuery()
            ->getResult();
        $router = $this->get('router');

        $session = $request->getSession();
        $shop = new Shop($this->container, $this->getDoctrine()->getManager());
        $currency = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Currency')
            ->find(intval($session->get('currency')));
        $collection = $router->getRouteCollection();
        return array(
            'cart' => $cart,
            'products' => $products,
            'router' => $collection,
            'shop' => $shop,
            'currency' => $currency
        );
    }

    /**
     * @Route("/add", name="site_cart_add")
     *
     */
    public function addAction(Request $request)
    {
        $response = new Response();
        $cart = unserialize($request->cookies->get('cart', serialize(array())));
        if ($request->request->get('product_id')) {
            $product = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->find($request->request->get('product_id'));
            if ($product) {
                $productCart = array(
                    'id' => $product->getId(),
                    'size' => $request->request->get('size'),
                    'color' => $request->request->get('color'),
                );
                if (!in_array($productCart, $cart)) {
                    $cart[] = $productCart;
                    $cookie = new Cookie('cart', serialize($cart), 0, '/', null, false, false);
                    $response->headers->setCookie($cookie);
                    $response->send();
                }

            }
        }
        return $response;

//        return $this->cartAction($request);
    }

    /**
     * @Route("/del", name="site_cart_del")
     * @Template("RleeCMSShopBundle:Site\Cart:cart.html.twig")
     */
    public function delAction(Request $request)
    {
        $cart = unserialize($request->cookies->get('cart', serialize(array())));
        if ($request->request->get('product_id')) {
            $i = 0;
            foreach ($cart as $c) {
                if ($request->request->get('product_id') == $c['id']) {
                    unset($cart[$i]);
                }
                $i++;
                $request->request->remove('product_id');
            }

        }
        $cookie = new Cookie('cart', serialize(array()), 0, '/', null, false, false);
        $response = new Response();
        $response->headers->setCookie($cookie);
        $response->send();
        return $response;
    }

    /**
     * Add wish
     *
     * @Route("/add_wish", name="site_cart_add_wish")
     */
    public function addWishAction(Request $request)
    {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('RleeCMSShopBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }
        $products = $user->getProducts();
        $flag = true;
        foreach ($products as $p) {
            if ($p->getId() == $product->getId()) {
                $flag = false;
            }
        }
        $data = array(
            'flag' => 'error',
            'msg' => $translator->trans('error')
        );
        if ($flag) {
            $product->addUser($user);
            $em->persist($product);
            $em->flush();
            $data = array(
                'flag' => 'success',
                'msg' => $translator->trans('PRODUCT ADD TO WISH LIST')
            );
        } else {
            $data = array(
                'flag' => 'warning',
                'msg' => $translator->trans('PRODUCT HAS BEEN ADDED TO WISH LIST')
            );
        }
        return new \Symfony\Component\HttpFoundation\JsonResponse($data);
    }
}
