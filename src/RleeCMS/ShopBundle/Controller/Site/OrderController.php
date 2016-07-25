<?php

namespace RleeCMS\ShopBundle\Controller\Site;

use Doctrine\ORM\QueryBuilder;
use RleeCMS\ShopBundle\Core\Shop;
use RleeCMS\ShopBundle\Entity\Product;
use RleeCMS\UserBundle\Entity\LegalPerson;
use RleeCMS\UserBundle\Entity\OrderingProducts;
use RleeCMS\UserBundle\Entity\Orders;
use RleeCMS\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Cart controller.
 * @Route("/orders")
 */
class OrderController extends Controller
{
    /**
     * @Route("/", name="site_order")
     * @Template()
     */
    public function indexAction(Request $request)
    {
//        $translator = $this->get('translator');
        $user = $this->getUser();
        $response = new Response();
        $cart = unserialize($request->cookies->get('cart', serialize(array())));
        if ($request->request->get('id')) {
            $product = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->find(intval($request->request->get('id')));
            if ($product) {
                $cart[] = $product->getId();
                $cookie = new Cookie('cart', serialize($cart), 0, '/', null, false, false);
                $response->headers->setCookie($cookie);
                $response->send();
            }
        }
//        /** @var QueryBuilder $qb */
//        $qb = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->createQueryBuilder('p');
//        $products = $qb
////            ->select('p')
//            ->where('p.id IN (:id)')
//            ->setParameter('id', $cart)
//            ->getQuery()
//            ->getResult();

        $products = array();
        foreach($cart as $key => $item){
          $product = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->find($item['id']);
          $color = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Color')->find($item['color']);
          $size = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Size')->find($item['size']);

            if($product){
                $quantity = $item['quantity'];
                $sizes = $size->getSize();

                foreach($products as $p){
                    if($p['type'] == $item['type'] and ($p['id'] == $product->getId()) and $p['colorId'] == $item['color']){
                        $key = $p['key'];
                        $quantity = $quantity + intval($p['quantity']);
                        $sizes = $p['size'].','.$size->getSize();
                        break;
                    }
                }

                $images = $product->getImages();
                if($product->getWebPath()){
                    $products[$key]['src'] = $images[0];
                }else{
                    $products[$key]['src'] = $product->getWebPath();
                }


                $products[$key]['key'] = $key;
                $products[$key]['id'] = $product->getId();
                $products[$key]['name'] = $product->getName();
                $products[$key]['size'] = $sizes;
                $products[$key]['color'] = $color->getName();
                $products[$key]['colorId'] = $color->getId();
                $products[$key]['price'] = $item['type']==6?$product->getPriceB2B():$product->getPrice();
                $products[$key]['quantity'] = $quantity;
                $products[$key]['type'] = $item['type'];
                $products[$key]['prontoType'] = isset($item['prontoType'])?$item['prontoType']:0;

            }

        }

        $router = $this->get('router');
        $collection = $router->getRouteCollection();
        $order = new Orders();
        $form = $this->createOrderForm($order);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() && count($cart)>0){
            $cnt = $request->get('count');
            $em = $this->getDoctrine()->getManager();
            foreach($cart as $key => $item){
                $product = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->find($item['id']);
                $color = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Color')->find($item['color']);
                $size = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Size')->find($item['size']);
                $type = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Category')->find($item['type']);
                if($product){
                    $orderingProduct =  new OrderingProducts();
                    $orderingProduct->setProduct($product);
                    $orderingProduct->setColor($color);
                    $orderingProduct->setSize($size);
                    $orderingProduct->setCount(isset($cnt[$key])?$cnt[$key]:1);
                    $orderingProduct->setType($type);
                    $orderingProduct->setProntoType( isset($item['prontoType'])?$item['prontoType']:0);
                    $em->persist($orderingProduct);
                    $order->addProduct($orderingProduct);
                }
            }
            if($user){
              $order->setUser($user);
            }
            $em->persist($order);
            $em->flush();
            $cookie = new Cookie('cart', serialize(array()), 0, '/', null, false, false);
            $response->headers->setCookie($cookie);
            $response->send();
            $this->sendMail($order);
            return $this->redirectToRoute('user_profile_orders');
        }

        $session = $request->getSession();
        $currency = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Currency')
            ->find(intval($session->get('currency')));
        return array(
            'cart' => $cart,
            'products' => $products,
            'router' => $collection,
            'form'   => $form->createView(),
            'shop'   => new Shop($this->container,$this->getDoctrine()->getManager()),
            'currency' => $currency,
        );
    }

    private function sendMail(Orders $order){
        $settings = $this->getDoctrine()->getRepository('UserBundle:Settings')->find(1);
        if($settings){
            $message = \Swift_Message::newInstance()
                ->setSubject('Новая заявка')
                /** @TODO Указать реальный mail */
                ->setFrom('toolai.fashion@gmail.com')
                ->setTo($settings->getEmail())
                ->setBody('<h1>Новый заказ на сайте</h1>',
                    /** @TODO Содержимое письма письма */
//                $this->renderView(
//                    'AppBundle:Default:email.html.twig',
//                    array()
//                ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            $html = '</br>';
            /** @var OrderingProducts $product */
            foreach($order->getProducts() as $product){
                $html .= $product->getProduct(). ' - ' . $product->getCount().'шт </br>';
            }
            $message = \Swift_Message::newInstance()
                ->setSubject('Вы успешно оформили заказ')
                /** @TODO Указать реальный mail */
                ->setFrom('toolai.fashion@gmail.com')
                ->setTo($order->getEmail())
                ->setBody('<h1>Вы заказали:</h1>'.$html,
                    /** @TODO Содержимое письма письма */
//                $this->renderView(
//                    'AppBundle:Default:email.html.twig',
//                    array()
//                ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }

    }

    /**
     * @param Orders $order
     * @return \Symfony\Component\Form\Form
     */
    private function createOrderForm(Orders $order){
        $translator = $this->get('translator');
        /** @var User $user */
        $user  = $this->getUser();
        if($user){
            $order->setEmail($user->getEmail());
            $order->setFName($user->getName());
            $order->setLName($user->getFName());
            /** @var LegalPerson $legalPerson */
            $legalPerson = $this->getDoctrine()->getRepository('UserBundle:LegalPerson')->findOneBy(array(
                'user' => $user->getId()
            ));
            if($legalPerson){
                $order->setHouseNumber($legalPerson->getFactHouseNumber());
                $order->setCity($legalPerson->getFactCity());
                $order->setCountry($legalPerson->getFactCountry());
                $order->setPIndex($legalPerson->getFactPIndex());
                $order->setPhone($legalPerson->getPhoneNumber());
            }
        }
        return $this->createForm('RleeCMS\UserBundle\Form\OrdersType', $order,array(
            'translator'=>$translator,
            'user' => $user
        ));
    }

    /**
     * @Route("/preview", name="site_order_preview")
     * @Template()
     */
    public function previewAction(Request $request){
        $translator = $this->get('translator');
        $cart = unserialize($request->cookies->get('cart', serialize(array())));
        $products = array();
        foreach($cart as $key => $item){
            $product = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')->find($item['id']);
            $color = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Color')->find($item['color']);
            $size = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Size')->find($item['size']);
            $quantity  = intval($item['quantity']);
            $infoTable = array(
               $size->getId() => $item['quantity']
            );
            if($product){

                foreach($products as $p){
                    if($p['type'] == $item['type'] and $p['id'] == $product->getId() /*and $item['type']==6*/ and $p['color']->getId() == $item['color']){
                        $key = $p['key'];
                        $quantity = $quantity + intval($p['quantity']);
                        $info = $p['infoTable'];
                        $quantityInfo = isset($info[$size->getId()])?intval($info[$size->getId()])+intval($item['quantity'])
                            :$item['quantity'];
                        $info[$size->getId()] = $quantityInfo;
                        $infoTable = $info;
                        break;
                    }
                }
                $products[$key]['key'] = $key;
                $products[$key]['id'] = $product->getId();
                $products[$key]['name'] = $product->getName();
                $products[$key]['size'] = $size->getId();
                $products[$key]['object'] = $product;
                $products[$key]['color'] = $color;
                $products[$key]['type'] = $item['type'];
                $products[$key]['quantity'] = $quantity;
                $products[$key]['price'] = $item['type']==6?$product->getPriceB2B():$product->getPrice();
                $products[$key]['prontoType'] = isset($item['prontoType'])?$item['prontoType']:0;
                $products[$key]['infoTable']  = $infoTable;

                $images = $product->getImages();
                if($product->getWebPath()){
                    $products[$key]['src'] = $images[0];
                }else{
                    $products[$key]['src'] = $product->getWebPath();
                }

            }

        }
        $router = $this->get('router');
        $collection = $router->getRouteCollection();
        $order = new Orders();
        $form = $this->createOrderForm($order);
        $form->handleRequest($request);


        $session = $request->getSession();
        $currency = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Currency')
            ->find(intval($session->get('currency')));
        return array(
            'cart' => $cart,
            'products' => $products,
            'router' => $collection,
            'form'   => $form->createView(),
            'shop'   => new Shop($this->container,$this->getDoctrine()->getManager()),
            'currency' => $currency,
            'prontoTypes' => CartController::getProntoTypes()
        );
    }

}
