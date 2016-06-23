<?php

namespace RleeCMS\ShopBundle\Controller\Site;

use RleeCMS\ShopBundle\Entity\ProductStore;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Index controller.
 *
 *
 */
class IndexController extends Controller
{
    /**
     * @Template()
     *
     */
    public function routerAction(Request $request, $alias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);
//        $request->cookies->set('test', 2);
//        var_dump($_COOKIE);
//        var_dump(opcache_get_status());
//        opcache_reset();
//        $cookie = new Cookie('wish', serialize(array('test',1,2)), 0, '/', null, false, false);
//        $response = new Response();
//        $response->headers->setCookie($cookie);
//        $response->headers->clearCookie('foo');
//        $response->send();
//        var_dump($request->cookies);

        $translator = $this->get('translator');

        $core = $this->get('rlee_cms_shop.core');
//        var_dump($core);
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdminCMSBundle:Menu');
        /** @var  $menu \RleeCMS\CMSBundle\Entity\Menu */
        $menu = $repository->findOneBy(array('alias' => $alias, 'status' => 1));
        $catId = $request->attributes->get('catId');
        if (!$menu || !$catId) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        $category = $em->getRepository('RleeCMSShopBundle:Category')->find($catId);
        if (!$category) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        $filters = $em->getRepository('RleeCMSShopBundle:Filters')->findAll();
        if (!$menu->getHome()) {
            $breadcrumbs = $this->get("white_october_breadcrumbs");
            // Simple example
            $breadcrumbs->addItem('Home', $this->generateUrl('site_index'));
            $breadcrumbs->addItem($menu->getTitle());
        }
        $filterId = $request->query->get('filter');
        $products = $em
            ->getRepository('RleeCMSShopBundle:Product')
            ->createQueryBuilder('p')
            ->leftJoin('p.categories', 'c')
            ->leftJoin('p.filters', 'f')
            ->andWhere('p.status = 1');
        if($catId == 6 || $catId == 7){
            $products = $products
                ->andWhere('p.categoryB2B = :catId')
                ->setParameter('catId', $category->getId());
        }else{
            $products = $products
            ->andWhere('c.id = :catId')
                ->setParameter('catId', $category->getId());
        }
        if (isset($filterId) and $filterId != 'all') {
            $products = $products
                ->andWhere('f.id = :filterId')
                ->setParameter('filterId', $filterId);
        }
        $products = $products
            ->orderBy('p.orderning', 'ASC')
            ->getQuery()->getResult();

        $result = array(
            'category' => $category,
            'menu' => $menu,
            'alias' => $alias,
            'filters' => $filters,
            'products' => $products
        );
        $view = "";
        if($catId == 6 || $catId == 7){
            $view = $this->renderView('@RleeCMSShop/Site/Index/routerB2B.html.twig',$result);
        }else{
            $view = $this->renderView('@RleeCMSShop/Site/Index/router.html.twig',$result);
        }
        return new Response($view);
    }

    /**
     * @Template()
     *
     */
    public function showProductAction(Request $request, $alias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);

        $translator = $this->get('translator');
//var_dump($request->attributes);
        $em = $this->getDoctrine()->getManager();
//        $repository = $em->getRepository('AdminCMSBundle:Menu');
        /** @var  $menu \RleeCMS\CMSBundle\Entity\Menu */
//        $menu = $repository->findOneBy(array('alias' => $alias, 'status' => 1));
        $catId = $request->attributes->get('catId');
        $productId = $request->attributes->get('productId');

//        if (!$menu || !$catId) {
//            throw $this->createNotFoundException($translator->trans('page_not_found'));
//        }
        $product = $em->getRepository('RleeCMSShopBundle:Product')->find($productId);
        if (!$product) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
//        var_dump($category);
//        die;
//        if (!$menu->getHome()) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        // Simple example
        $breadcrumbs->addItem('Главная', $this->generateUrl('site_index'));
//            $breadcrumbs->addItem($menu->getTitle());
//        }
//        $table = array();
//        /** @var  $size \RleeCMS\ShopBundle\Entity\Size */
//        $heights = array();
//        foreach ($product->getSizes() as $size) {
//            if ($size->getHeight()) {
//                $heights[] = $size->getHeight();
//            }
//            $name[] = $size->getSize();
//            $bust[] = $size->getBust();
//            $waist[] = $size->getWaist();
//            $hips[] = $size->getHips();
//            $front_waist_length[] = $size->getFrontWaistLength();
//            $bust_depth[] = $size->getBustDepth();
//            $back_length[] = $size->getBackLength();
//            $back_width[] = $size->getBackWidth();
//            $shoulder_width[] = $size->getShoulderWidth();
//            $hand_length[] = $size->getHandLength();
//        }
//        $minMaxHeight = '';
//        if (count($heights) > 0) {
//            $max = max($heights);
//            $min = min($heights);
//            if (isset($min) and isset($max)) {
//                if ($max == $min) {
//                    $minMaxHeight = $min;
//                } else {
//                    $minMaxHeight = $min . ' - ' . $max;
//                }
//            } else if (isset($min)) {
//                $minMaxHeight = $min;
//            } else if (isset($max)) {
//                $minMaxHeight = $max;
//            }
//        }
        $table = array(
            $translator->trans('HEIGHT').' 167-174' => '',//$minMaxHeight,
            //$translator->trans('SIZE STABLE FABRICS') => $name,
            $translator->trans('Bust') => '',//$bust,
            $translator->trans('Waist') => '',//$waist,
            $translator->trans('Hips') => '',//$hips,
//            $translator->trans('Front waist length') => $front_waist_length,
//            $translator->trans('Bust depth') => $bust_depth,
//            $translator->trans('Back length') => $back_length,
//            $translator->trans('Bask width') => $back_width,
//            $translator->trans('Shoulder width') => $shoulder_width,
//            $translator->trans('Hand length') => $hand_length,

        );

        $flag = false;
        if ($this->getUser()) {
            $products = $this->getUser()->getProducts();
            foreach ($products as $p) {
                if ($p->getId() == $product->getId()) {
                    $flag = true;
                }
            }
        }
        $stores = $em
            ->getRepository('RleeCMSShopBundle:ProductStore')
            ->createQueryBuilder('s')
            ->andWhere('s.product = :pId')
            ->andWhere('s.count != 0')
            ->setParameter('pId', $product->getId())
            ->getQuery()->getResult();
        $countStores = count($stores);
        $colorArray = array();
        $sizeArray = array();
        foreach ($stores as $store) {
            $colorArray[] = $store->getColor()->getId();
            $sizeArray[] = $store->getSize()->getId();
        }
        $sizeArray = array_unique($sizeArray);
        $colorArray = array_unique($colorArray);
        return array(
            'product' => $product,
            'table' => $table,
            'flag' => $flag,
            'stores' => $stores,
            'countStores' => $countStores,
            'sizeArray' => $sizeArray,
            'colorArray' => $colorArray
        );
    }

    /**
     * @Template()
     *
     */
    public function showProntoProductAction(Request $request, $alias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);

        $translator = $this->get('translator');
        $em = $this->getDoctrine()->getManager();
        /** @var  $menu \RleeCMS\CMSBundle\Entity\Menu */
        $catId = $request->attributes->get('catId');
        $productId = $request->attributes->get('productId');

        $product = $em->getRepository('RleeCMSShopBundle:Product')->find($productId);
        if (!$product) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Главная', $this->generateUrl('site_index'));



        $flag = false;
        if ($this->getUser()) {
            $products = $this->getUser()->getProducts();
            foreach ($products as $p) {
                if ($p->getId() == $product->getId()) {
                    $flag = true;
                }
            }
        }
        $stores = $em
            ->getRepository('RleeCMSShopBundle:ProductStore')
            ->createQueryBuilder('s')
            ->andWhere('s.product = :pId')
            ->andWhere('s.count != 0')
            ->setParameter('pId', $product->getId())
            ->getQuery()->getResult();
        $countStores = count($stores);
        $colorArray = array();
        $sizeArray = array();
        foreach ($stores as $store) {
            $colorArray[] = $store->getColor()->getId();
            $sizeArray[] = $store->getSize()->getId();
        }
        $sizeArray = array_unique($sizeArray);
        $colorArray = array_unique($colorArray);
        return array(
            'product' => $product,
            'flag' => $flag,
            'stores' => $stores,
            'countStores' => $countStores,
            'sizeArray' => $sizeArray,
            'colorArray' => $colorArray
        );
    }

    /**
     * @Template()
     *
     */
    public function showStockProductAction(Request $request, $alias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);

        $translator = $this->get('translator');
        $em = $this->getDoctrine()->getManager();
        /** @var  $menu \RleeCMS\CMSBundle\Entity\Menu */
        $catId = $request->attributes->get('catId');
        $productId = $request->attributes->get('productId');

        $product = $em->getRepository('RleeCMSShopBundle:Product')->find($productId);
        if (!$product) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Главная', $this->generateUrl('site_index'));



        $flag = false;
        if ($this->getUser()) {
            $products = $this->getUser()->getProducts();
            foreach ($products as $p) {
                if ($p->getId() == $product->getId()) {
                    $flag = true;
                }
            }
        }
        $stores = $em
            ->getRepository('RleeCMSShopBundle:ProductStore')
            ->createQueryBuilder('s')
            ->andWhere('s.product = :pId')
            ->andWhere('s.count != 0')
            ->setParameter('pId', $product->getId())
            ->getQuery()->getResult();
        $countStores = count($stores);
        $colorArray = array();
        $sizeArray = array();
        $storeData = array();
        $data = array();
        /** @var ProductStore $store */
        foreach ($stores as $store) {
            $colorArray[] = $store->getColor()->getId();
            $sizeArray[] = $store->getSize()->getId();
            $storeData[$store->getStore()->getId()] = array(
               'name' => $store->getStore()->getName(),
                'id' => $store->getStore()->getId()
            );
        }
        foreach($storeData as $sd){
            $results
                =  $em
                ->getRepository('RleeCMSShopBundle:ProductStore')
                ->createQueryBuilder('s')
                ->andWhere('s.product = :pId')
                ->andWhere('s.store = :store')
                ->andWhere('s.count != 0')
                ->setParameter('pId', $product->getId())
                ->setParameter('store', $sd['id'])
                ->getQuery()->getResult();
            /** @var ProductStore $result */
            foreach($results as $result){
                $data[$result->getStore()->getId()][$result->getColor()->getId()][$result->getSize()->getId()]
                =
                $result;
            }
        }
        $sizeArray = array_unique($sizeArray);
        $colorArray = array_unique($colorArray);
        return array(
            'product' => $product,
            'flag' => $flag,
            'stores' => $stores,
            'countStores' => $countStores,
            'sizeArray' => $sizeArray,
            'colorArray' => $colorArray,
            'storeData' => $storeData,
            'data'      => $data,
            'store' => new ProductStore
        );
    }
}
