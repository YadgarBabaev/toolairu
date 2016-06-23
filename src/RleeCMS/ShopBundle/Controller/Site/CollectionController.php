<?php

namespace RleeCMS\ShopBundle\Controller\Site;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

/**
 * Collection controller.
 *
 *
 */
class CollectionController extends Controller
{
    /**
     * @Template()
     *
     */
    public function routerAction(Request $request, $alias, $b2b = false)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);

        $translator = $this->get('translator');
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
        if (!$menu->getHome()) {
            $breadcrumbs = $this->get("white_october_breadcrumbs");
            // Simple example
            $breadcrumbs->addItem('Home', $this->generateUrl('site_index'));
            $breadcrumbs->addItem($menu->getTitle());
        }
        if ($b2b) {
            $lastUsername = '';
            $csrfToken = '';
            if (!$this->getUser() || ($this->getUser() && !$this->getUser()->getLegalPerson())) {
                if (class_exists('\Symfony\Component\Security\Core\Security')) {
                    $lastUsernameKey = Security::LAST_USERNAME;
                }
                // last username entered by the user
                $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
                if ($this->has('security.csrf.token_manager')) {
                    $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
                } else {
                    // BC for SF < 2.4
                    $csrfToken = $this->has('form.csrf_provider')
                        ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
                        : null;
                }
            }

            $pret_a_porter = $em->getRepository('RleeCMSShopBundle:Category')->findOneBy(array(
                'b2b' => 'pret-a-porter',
                'parent' => $category->getId()
            ));
//            var_dump($pret_a_porter);
            $pronto = $em->getRepository('RleeCMSShopBundle:Category')->findOneBy(array(
                'b2b' => 'pronto',
                'parent' => $category->getId()
            ));
            $stock = $em->getRepository('RleeCMSShopBundle:Category')->findOneBy(array(
                'b2b' => 'stock',
                'parent' => $category->getId()
            ));
            return $this->render('@RleeCMSShop/Site/Collection/b2b.html.twig', array(
                'category' => $category,
                'menu' => $menu,
                'alias' => $alias,
                'pret_a_porter' => $pret_a_porter,
                'pronto' => $pronto,
                'stock' => $stock,
                'last_username' => $lastUsername,
                'csrf_token' => $csrfToken,
            ));
        } else {
            $mainPrevious = $em
                ->getRepository('RleeCMSShopBundle:Category')
                ->createQueryBuilder('c')
                ->andWhere('c.status = 1')
                ->andWhere('c.sale = 0')
                ->andWhere('c.parent = :catId')
                ->setParameter('catId', $category->getId())
                ->orderBy('c.orderning', 'ASC')
                ->setMaxResults(4)
                ->getQuery()->getResult();
            $previous = $em
                ->getRepository('RleeCMSShopBundle:Category')
                ->createQueryBuilder('c')
                ->andWhere('c.status = 1')
                ->andWhere('c.sale = 0')
                ->andWhere('c.parent = :catId')
                ->setParameter('catId', $category->getId())
                ->orderBy('c.orderning', 'ASC')
                ->setFirstResult(4)
                ->getQuery()->getResult();
            $sales = $em->getRepository('RleeCMSShopBundle:Category')->findBy(
                array(
                    'parent' => $category->getId(),
                    'sale' => 1,
                    'status' => 1
                ),
                array(
                    'orderning' => 'ASC'
                )
            );
            return array(
                'category' => $category,
                'menu' => $menu,
                'alias' => $alias,
                'mainPrevious' => $mainPrevious,
                'previous' => $previous,
                'sales' => $sales,

            );
        }
    }

    /**
     * @Template()
     *
     */
    public function showPreviousAction(Request $request, $alias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);

        $translator = $this->get('translator');
        $em = $this->getDoctrine()->getManager();

        $catId = $request->attributes->get('catId');
        $category = $em->getRepository('RleeCMSShopBundle:Category')->find($catId);
        if (!$category) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        $filters = $em->getRepository('RleeCMSShopBundle:Filters')->findAll();
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Главная', $this->generateUrl('site_index'));

        $filterId = $request->query->get('filter');
        $products = $em
            ->getRepository('RleeCMSShopBundle:Product')
            ->createQueryBuilder('p')
            ->leftJoin('p.filters', 'f')
            ->andWhere('p.status = 1')
            ->andWhere('p.category = :catId')
            ->setParameter('catId', $category->getId());
        if (isset($filterId) and $filterId != 'all') {
            $products = $products
                ->andWhere('f.id = :filterId')
                ->setParameter('filterId', $filterId);
        }
        $products = $products
            ->orderBy('p.orderning', 'ASC')
            ->getQuery()->getResult();

        return array(
            'category' => $category,
            'filters' => $filters,
            'products' => $products
        );
    }

    /**
     *
     */
    public function showShopByLookAction(Request $request, $alias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);

        $translator = $this->get('translator');
        $em = $this->getDoctrine()->getManager();

        $catId = $request->attributes->get('catId');
        $category = $em->getRepository('RleeCMSShopBundle:Category')->find($catId);
        if (!$category) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Главная', $this->generateUrl('site_index'));

        $shopByLookId = $request->query->get('to');
        if (isset($shopByLookId)) {
            $shopByLook = $em->getRepository('RleeCMSShopBundle:ShopByLook')->findOneBy(array(
                'status' => 1,
                'id' => $shopByLookId
            ));
            if (!$shopByLook) {
                throw $this->createNotFoundException($translator->trans('page_not_found'));
            }
            $product_table = array();
            $flagArray = array();
            $mainCountStores = array();
            $mainSizeArray = array();
            $mainColorArray = array();
            foreach ($shopByLook->getProducts() as $product) {
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
                $mainCountStores[$product->getId()] = $countStores;
                $mainSizeArray[$product->getId()] = $sizeArray;
                $mainColorArray[$product->getId()] = $colorArray;
                
                $flag = false;
                if ($this->getUser()) {
                    $products = $this->getUser()->getProducts();
                    foreach ($products as $p) {
                        if ($p->getId() == $product->getId()) {
                            $flag = true;
                        }
                    }
                }
                $flagArray[$product->getId()] = $flag;
                $table = array();
                $heights = array();
                /** @var  $size \RleeCMS\ShopBundle\Entity\Size */
                foreach ($product->getSizes() as $size) {
                    if ($size->getHeight()) {
                        $heights[] = $size->getHeight();
                    }
                    $name[] = $size->getSize();
                    $bust[] = $size->getBust();
                    $waist[] = $size->getWaist();
                    $hips[] = $size->getHips();
                    $front_waist_length[] = $size->getFrontWaistLength();
                    $bust_depth[] = $size->getBustDepth();
                    $back_length[] = $size->getBackLength();
                    $back_width[] = $size->getBackWidth();
                    $shoulder_width[] = $size->getShoulderWidth();
                    $hand_length[] = $size->getHandLength();
                }
                $minMaxHeight = '';
                if (count($heights) > 0) {
                    $max = max($heights);
                    $min = min($heights);
                    if (isset($min) and isset($max)) {
                        if ($max == $min) {
                            $minMaxHeight = $min;
                        } else {
                            $minMaxHeight = $min.' - '.$max;
                        }
                    } else if (isset($min)) {
                        $minMaxHeight = $min;
                    } else if (isset($max)) {
                        $minMaxHeight = $max;
                    }
                }
                $table = array(
                    $translator->trans('HEIGHT').' 167-174' => '',//$minMaxHeight,
                    //$translator->trans('SIZE STABLE FABRICS') => $name,
                    $translator->trans('Bust') => '',//$bust,
                    $translator->trans('Waist') => '',//$waist,
                    $translator->trans('Hips') => '',//$hips,

                );
                $product_table[$product->getId()] = $table;
            }

            return $this->render('RleeCMSShopBundle:Site:Collection\showShopByLook.html.twig', array(
                'shopByLook' => $shopByLook,
                'productTable' => $product_table,
                'flagArray' => $flagArray,
                'mainCountStores' => $mainCountStores,
                'mainSizeArray' => $mainSizeArray,
                'mainColorArray' => $mainColorArray
            ));
        }

        $shopByLooks = $em
            ->getRepository('RleeCMSShopBundle:ShopByLook')
            ->createQueryBuilder('sh')
            ->andWhere('sh.status = 1')
            ->andWhere('sh.category = :catId')
            ->setParameter('catId', $category->getId())
            ->orderBy('sh.orderning')
            ->getQuery()->getResult();

        return $this->render('RleeCMSShopBundle:Site:Collection\shopByLook.html.twig', array(
                'category' => $category,
                'shopByLooks' => $shopByLooks,
                'alias' => $alias
            )
        );
    }
}
