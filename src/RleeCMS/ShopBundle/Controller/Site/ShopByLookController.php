<?php

namespace RleeCMS\ShopBundle\Controller\Site;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * ShopByLook controller.
 *
 *
 */
class ShopByLookController extends Controller
{
    /**
     *
     */
    public function indexAction(Request $request, $alias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);
        $translator = $this->get('translator');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdminCMSBundle:Menu');
        /** @var  $menu \RleeCMS\CMSBundle\Entity\Menu */
        $menu = $repository->findOneBy(array('alias' => $alias, 'status' => 1));

        if (!$menu) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        if (!$menu->getHome()) {
            $breadcrumbs = $this->get("white_october_breadcrumbs");
            // Simple example
            $breadcrumbs->addItem('Home', $this->generateUrl('site_index'));
            $breadcrumbs->addItem($menu->getTitle());
        }
        $shopByLookId = $request->query->get('to');
        if (isset($shopByLookId)) {
            $shopByLook = $em->getRepository('RleeCMSShopBundle:ShopByLook')->findOneBy(array(
                'status' => 1,
                'id' => $shopByLookId
            ));
            if (!$shopByLook) {
                throw $this->createNotFoundException($translator->trans('page_not_found'));
            }

            return $this->render('RleeCMSShopBundle:Site:ShopByLook\show.html.twig', array(
                'shopByLook' => $shopByLook,
            ));
        }
        $shopByLooks = $em
            ->getRepository('RleeCMSShopBundle:ShopByLook')
            ->createQueryBuilder('sh')
            ->andWhere('sh.status = 1')
            ->orderBy('sh.orderning')
            ->getQuery()->getResult();
        return $this->render('RleeCMSShopBundle:Site:ShopByLook\index.html.twig', array(
            'shopByLooks' => $shopByLooks,
            'menu' => $menu,
            'alias' => $alias
        ));
    }
}
