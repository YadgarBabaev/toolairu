<?php

namespace RleeCMS\ShopBundle\Controller\Site;

use Doctrine\ORM\QueryBuilder;
use RleeCMS\ShopBundle\Core\Shop;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
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


        $items = array();
        if(is_array($cart)){
            foreach($cart as $key => $cartItem){
                if(isset($cartItem['id'])){
                    $product = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->find($cartItem['id']);
                    $quantity = $cartItem['quantity'];
                    if(isset($items[$product->getId()]) and $items[$product->getId()]['type'] == $cartItem['type']){
                        $quantity =  intval($items[$product->getId()]['quantity']) + $quantity;
                    }
                        $items[$product->getId()] = array(
                            'product' =>  $product,
                            'type'    => $cartItem['type'],
                            'id'  => $key,
                            'quantity' => $quantity
                        ) ;
                }
            }
        }
        $router = $this->get('router');

        $session = $request->getSession();
        $shop = new Shop($this->container, $this->getDoctrine()->getManager());
        $currency = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Currency')
            ->find(intval($session->get('currency')));
        $collection = $router->getRouteCollection();
        return array(
            'cart' => $cart,
            'items' => $items,
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
        $count = $request->request->get('count');
        $response = new Response();
        $cart = unserialize($request->cookies->get('cart', serialize(array())));
        if ($request->request->get('product_id')) {
            $product = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->find($request->request->get('product_id'));
            if ($product) {
                $productCart = array(
                    'id' => $product->getId(),
                    'size' => $request->request->get('size'),
                    'color' => $request->request->get('color'),
                    'type'  => 1,
                    'quantity' => $count>1?$count:1
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
     * @Route("/b2b_add", name="site_cart_b2b_add")
     *
     */
    public function b2bAddAction(Request $request)
    {
        $response = new Response();
        $colors = $request->request->get('color');
        $sizes  = $request->request->get('size');
        $productId = $request->request->get('product_id');
        $prontoType = $request->request->get('pronto_type');

        if ($request->request->get('product_id')) {
            $product = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')
                ->find($productId);
        $cart = unserialize($request->cookies->get('cart', serialize(array())));

            if ($product && is_array($colors) && is_array($sizes)) {
                foreach($colors as $key => $value){
                    if(isset($sizes[$key])){
                        $isset = false;
                        foreach($cart as $k => $v){
                            if($v['color'] == $value && $v['id'] == $product->getId() && $v['size'] == $sizes[$key]){
                                $cart[$k]['quantity'] =  intval($v['quantity'])+1;
                                $isset = true;
                            }
                        }
                        if(!$isset){
                            $productCart = array(
                                'id' => $product->getId(),
                                'size' => $sizes[$key],
                                'color' => $value,
                                'type'  => 6,
                                'prontoType' => $prontoType,
                                'quantity' => 1
                            );
                            $cart[] = $productCart;
                        }
                            $cookie = new Cookie('cart', serialize($cart), 0, '/', null, false, false);
                            $response->headers->setCookie($cookie);

                    }
                }
                $response->send();
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
                $id = $request->request->get('product_id');
                foreach($cart as $key => $c){
                    if($c['id'] == $id){
                        unset($cart[$key]);
                    }
                }

        $cookie = new Cookie('cart', serialize($cart), 0, '/', null, false, false);
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


    public static function getProntoTypes(){
        return array(
            0 => array(
                'length' => 6,
                'percent' => '30'
            ),
            1 =>array(
                'length' => 3,
                'percent' => '30'
            ),
            2 => array(
                'length' => 1,
                'percent' => '50'
            ),
        );
    }

    /**
     * Add wish
     *
     * @Route("/update", name="site_cart_update")
     */
    public function updateAction(Request $request)
    {
        $response = new Response();
        $id = $request->request->get('id');
        $key = $request->request->get('key');
        $size = $request->request->get('size');
        $color = $request->request->get('color');
        $type = $request->request->get('type');
        $prontoType = $request->request->get('prontoType');
        $quantity = $request->request->get('quantity');
        $cart = unserialize($request->cookies->get('cart', serialize(array())));

        if($id && $key != null && $size && $color && $quantity && $type && isset($cart[$key])){

            $data['id'] = $id;
            $data['size'] = $size;
            $data['color'] = $color;
            $data['type'] = $type;
            $data['quantity'] = $quantity;
            $data['prontoType'] =  $prontoType;
            $cart[$key] = $data;
            $cookie = new Cookie('cart', serialize($cart), 0, '/', null, false, false);
            $response->headers->setCookie($cookie);
            $response->send();

        }
        return $response;

    }
}
