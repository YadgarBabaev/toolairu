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
        $translator = $this->get('translator');
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Главная', $this->generateUrl('site_index'));

        return array(
            'user' => $user
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

    /**
     * Deletes a Product entity from Wish list.
     *
     * @Route("/{id}/delete", name="site_wish_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('RleeCMSShopBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }
        $user = $this->getUser();
        
        $product->removeUser($user);
        $em->persist($product);
        $em->flush();


        return $this->redirect($this->generateUrl('site_wish'));
    }
}
