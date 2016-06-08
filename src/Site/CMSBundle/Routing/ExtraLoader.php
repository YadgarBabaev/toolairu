<?php

namespace Site\CMSBundle\Routing;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class ExtraLoader implements LoaderInterface
{
    private $loaded = false;
    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "extra" loader twice');
        }
        $routes = new RouteCollection();
        $em = $this->doctrine->getManager();
        $repository = $em->getRepository('AdminCMSBundle:Menu');
        $menus = $repository->findBy(array('status' => 1, 'lvl' => 0));
//        die;
        /** @var \RleeCMS\CMSBundle\Entity\Menu $menu */
        foreach ($menus as $menu) {

            if ($menu->getType() == 'content') {
                $path = $menu->getAlias() . '.html';
                $defaults = array(
                    '_controller' => 'CMSBundle:Pages:router',
                    'alias' => $menu->getAlias(),
                    'menuId' => $menu->getId()

                );
                $routeName = $menu->getAlias() . '_' . $menu->getId();
                if ($menu->getHome()) {
                    $path = '';
                    $defaults = array(
                        '_controller' => 'CMSBundle:Pages:router',
                        'alias' => $menu->getAlias(),
                        'menuId' => $menu->getId()
                    );
                    $routeName = 'index';
                }
                $route = new Route($path, $defaults);
                $routes->add($routeName, $route);
            }

            if ($menu->getChildren()) {
                foreach ($menu->getChildren() as $children) {
                    $path = $children->getAlias() . '.html';
                    $defaults = array(
                        '_controller' => 'CMSBundle:Pages:router',
                        'alias' => $children->getAlias(),
                        'menuId' => $menu->getId()
                    );
                    $routeName = $menu->getAlias() . '_' . $menu->getId() . '_' . $children->getAlias() . '_' . $children->getId();
                    $route = new Route($path, $defaults);
                    $routes->add($routeName, $route);
                }
            }
            if ($menu->getType() == 'blog') {
                $path = $menu->getAlias() . '.html';
                $defaults = array(
                    '_controller' => 'CMSBundle:Pages:router',
                    'alias' => $menu->getAlias(),
                    'menuId' => $menu->getId()

                );
                $routeName = $menu->getAlias() . '_' . $menu->getId();
                $route = new Route($path, $defaults);
                $routes->add($routeName, $route);
                $page = $menu->getPage();
                if ($page->getChildren()) {
                    foreach ($page->getChildren() as $children) {
                        $path = $menu->getAlias() . '/' . $children->getAlias() . '.html';
                        $defaults = array(
                            '_controller' => 'CMSBundle:Pages:blogShow',
                            'alias' => $menu->getAlias(),
                            'blogAlias' => $children->getAlias()
                        );
                        $routeName = $menu->getAlias() . '_' . $menu->getId() . '_' . $children->getAlias() . '_' . $children->getId();
                        $route = new Route($path, $defaults);
                        $routes->add($routeName, $route);
                    }
                }
//                var_dump($routes);
//                die;
            }
            if ($menu->getType() == 'shop') {
                if (isset($menu->getParams()['cat_id'])) {
                    $catId = $menu->getParams()['cat_id'];
                    /** @var \RleeCMS\ShopBundle\Entity\Category $category */
                    $category = $em->getRepository('RleeCMSShopBundle:Category')->find($catId);
                    $showProductController = 'RleeCMSShopBundle:Site\Index:showProduct';
                    if ($category) {
                        if($catId == 6){
                            $products = $em
                                ->getRepository('RleeCMSShopBundle:Product')
                                ->createQueryBuilder('p')
                                ->leftJoin('p.categories', 'c')
                                ->leftJoin('p.filters', 'f')
                                ->andWhere('p.status = 1')
                                ->andWhere('p.categoryB2B = :catId')
                                ->setParameter('catId', $category->getId())
                                ->getQuery()->getResult();
                            $showProductController = 'RleeCMSShopBundle:Site\Index:showProntoProduct';

                        }
                        else{
                            $products = $category->getProducts();
                        }

                        $path = $menu->getAlias() . '.html';
                        $defaults = array(
                            '_controller' => 'RleeCMSShopBundle:Site\Index:router',
                            'alias' => $menu->getAlias(),
                            'catId' => $menu->getParams()['cat_id']
                        );
                        $routeName = 'category_' . $category->getId();
                        $route = new Route($path, $defaults);
                        $routes->add($routeName, $route);

                        /** @var \RleeCMS\ShopBundle\Entity\Product $product */
                        foreach ($category->getProductsOnly() as $product) {

                            $path = $menu->getAlias() . '/' . $product->getAlias() . '.html';
                            $defaults = array(
                                '_controller' => $showProductController,
                                'alias' => $menu->getAlias() . '/' . $product->getAlias(),
                                'catId' => $menu->getParams()['cat_id'],
                                'productId' => $product->getId(),
                            );
                            $routeName = 'product_' . $product->getId();
                            $route = new Route($path, $defaults);
                            $routes->add($routeName, $route);
                        }
                        /** @var \RleeCMS\ShopBundle\Entity\Product $product */
                        foreach ($products as $product) {
                            $path = $menu->getAlias() . '/' . $product->getAlias() . '.html';
                            $defaults = array(
                                '_controller' => $showProductController,
                                'alias' => $menu->getAlias() . '/' . $product->getAlias(),
                                'catId' => $menu->getParams()['cat_id'],
                                'productId' => $product->getId(),
                            );
                            $routeName = 'product_' .$category->getId().'_'. $product->getId();
                            $route = new Route($path, $defaults);
                            $routes->add($routeName, $route);
                        }
                    }
                }
            }
            if ($menu->getType() == 'collection') {
                if (isset($menu->getParams()['cat_id'])) {

                    /** @var \RleeCMS\ShopBundle\Entity\Category $category */
                    $category = $em->getRepository('RleeCMSShopBundle:Category')->find($menu->getParams()['cat_id']);
                    if ($category) {
                        $path = $menu->getAlias() . '.html';
                        $defaults = array(
                            '_controller' => 'RleeCMSShopBundle:Site\Collection:router',
                            'alias' => $menu->getAlias(),
                            'catId' => $menu->getParams()['cat_id']
                        );
                        $routeName = 'collection_' . $category->getId();
                        $route = new Route($path, $defaults);
                        $routes->add($routeName, $route);

                        /** @var \RleeCMS\ShopBundle\Entity\Category $children */
                        foreach ($category->getChildren() as $children) {
                            if ($children->getSale()) {
                                if ($category->getShopbylook()) {
                                    $path = $menu->getAlias() . '/' . $children->getAlias() . '.html';
                                    $defaults = array(
                                        '_controller' => 'RleeCMSShopBundle:Site\Collection:showShopByLook',
                                        'alias' => $menu->getAlias() . '/' . $children->getAlias(),
                                        'catId' => $children->getId(),
                                    );
                                    $routeName = 'collection_shopbylook_' . $children->getId();
                                    $route = new Route($path, $defaults);
                                    $routes->add($routeName, $route);
                                }
                            } else {
                                $path = $menu->getAlias() . '/' . $children->getAlias() . '.html';
                                $defaults = array(
                                    '_controller' => 'RleeCMSShopBundle:Site\Collection:showPrevious',
                                    'alias' => $menu->getAlias() . '/' . $children->getAlias(),
                                    'catId' => $children->getId(),
                                );
                                $routeName = 'collection_previous_' . $children->getId();
                                $route = new Route($path, $defaults);
                                $routes->add($routeName, $route);
                            }
                        }
                    }
                }
            }
            if ($menu->getType() == 'b2b') {
                if (isset($menu->getParams()['cat_id'])) {
                    /** @var \RleeCMS\ShopBundle\Entity\Category $category */
                    $category = $em->getRepository('RleeCMSShopBundle:Category')->find($menu->getParams()['cat_id']);
                    if ($category) {
                        $path = $menu->getAlias() . '.html';
                        $defaults = array(
                            '_controller' => 'RleeCMSShopBundle:Site\Collection:router',
                            'alias' => $menu->getAlias(),
                            'b2b' => true,
                            'catId' => $menu->getParams()['cat_id']
                        );
                        $routeName = 'collection_' . $category->getId();
                        $route = new Route($path, $defaults);
                        $routes->add($routeName, $route);

                        /** @var \RleeCMS\ShopBundle\Entity\Category $children */
                        foreach ($category->getChildren() as $children) {
                            if ($category->getShopbylook()) {
                                $path = $menu->getAlias() . '/' . $children->getAlias() . '.html';
                                $defaults = array(
                                    '_controller' => 'RleeCMSShopBundle:Site\Collection:showShopByLook',
                                    'alias' => $menu->getAlias() . '/' . $children->getAlias(),
                                    'catId' => $children->getId(),
                                );
                                $routeName = 'collection_shopbylook_' . $children->getId();
                                $route = new Route($path, $defaults);
                                $routes->add($routeName, $route);
                            }
                        }
                    }
                }
            }

            if ($menu->getType() == 'shop_by_look') {
                $path = $menu->getAlias() . '.html';
                $defaults = array(
                    '_controller' => 'RleeCMSShopBundle:Site\ShopByLook:index',
                    'alias' => $menu->getAlias()
                );
                $routeName = $menu->getAlias() . '_' . $menu->getId();
                $route = new Route($path, $defaults);
                $routes->add($routeName, $route);
            }
            if ($menu->getType() == 'feedback') {
                $path = $menu->getAlias() . '.html';
                $defaults = array(
                    '_controller' => 'RleeCMSShopBundle:Site\Feedback:index',
                    'alias' => $menu->getAlias()
                );
                $routeName = 'feedback_' . $menu->getId();
                $route = new Route($path, $defaults);
                $routes->add($routeName, $route);
            }
        }
        $this->loaded = true;
        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'extra' === $type;
    }

    public function getResolver()
    {
        // needed, but can be blank, unless you want to load other resources
        // and if you do, using the Loader base class is easier (see below)
    }

    public function setResolver(LoaderResolverInterface $resolver)
    {
        // same as above
    }
} 