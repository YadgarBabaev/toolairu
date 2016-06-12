<?php

namespace RleeCMS\ShopBundle\Controller\Site;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Wish controller.
 * @Route("/wish")
 */
class WishController extends Controller
{
    /**
     * @Route("/", name="site_wish")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        //$translator = $this->get('translator');
        $ids = unserialize($request->cookies->get('wish', serialize(array())));

        $products = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Product')
            ->createQueryBuilder('p')
            ->where('p.id IN (:ids)')
            ->setParameter(':ids',$ids)
            ->getQuery()->getResult();

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Главная', $this->generateUrl('site_index'));

        return array(
            'products' => $products,

        );
    }

    /**
     * Add wish
     *
     * @Route("/add", name="site_wish_add")
     */
    public function addAction(Request $request)
    {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('RleeCMSShopBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }
        $flag = true;
        $ids = unserialize($request->cookies->get('wish', serialize(array())));
        if(in_array($id,$ids)){
            $flag = false;
        }
        $data = array(
            'flag' => 'error',
            'msg' => $translator->trans('error')
        );
        if ($flag) {
            $ids[] = $product->getId();
            $response = new Response();
            $response->headers->setCookie(new Cookie( 'wish',serialize($ids),0, '/', null, false, false));
            $response->send();
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

    /**
     * Deletes a Product entity from Wish list.
     *
     * @Route("/{id}/delete", name="site_wish_delete")
     */
    public function deleteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('RleeCMSShopBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }
        $ids = unserialize($request->cookies->get('wish', serialize(array())));
        foreach($ids as $key => $value){
            if($id == $value){
                unset($ids[$key]);
            }
        }
        $response = new Response();
        $response->headers->setCookie(new Cookie( 'wish',serialize($ids),0, '/', null, false, false));
        $response->send();


        return $this->redirect($this->generateUrl('site_wish'));
    }
}
