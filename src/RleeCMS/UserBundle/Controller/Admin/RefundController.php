<?php

namespace RleeCMS\UserBundle\Controller\Admin;

use RleeCMS\ShopBundle\Entity\Refund;
use RleeCMS\ShopBundle\Form\RefundType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Status controller.
 *
 * @Route("/admin/refund")
 */
class RefundController extends Controller
{
    /**
     *
     * @Route("/", name="admin_refund")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {


        $refund = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Refund')->findAll();

        return array('refund' => $refund);

    }

    /**
     *
     * @Route("/show/{id}", name="admin_refund_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Request $request,Refund $refund)
    {
        return array(
            'entity' => $refund,
        );

    }

    /**
     *
     * @Route("/edit/{id}", name="admin_refund_edit")
     * @Template()
     */
    public function editAction(Request $request,Refund $refund)
    {

        $form = $this->createForm(RefundType::class, $refund);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $em = $this->getDoctrine()->getManager();
            $em->persist($refund);
            $em->flush();
            return $this->redirectToRoute('admin_refund');
        }
        return array(
            'refund' => $refund,
            'form' => $form->createView()
            );

    }

    /**
     * @Route("/delete/{id}", name="admin_refund_delete")
     */
    public function deleteAction(Refund $refund){
        $em = $this->getDoctrine()->getManager();
        $em->remove($refund);
        $em->flush();
        return $this->redirectToRoute('admin_refund');
    }

}