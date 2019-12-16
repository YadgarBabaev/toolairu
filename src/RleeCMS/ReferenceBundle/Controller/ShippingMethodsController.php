<?php

namespace RleeCMS\ReferenceBundle\Controller;

use RleeCMS\ReferenceBundle\Entity\ShippingMethods;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ReferenceBundle\Entity\Status;
use RleeCMS\ReferenceBundle\Form\StatusType;

/**
 * Status controller.
 *
 * @Route("/shipping_methods")
 */
class ShippingMethodsController extends Controller
{

    /**
     * Lists all Status entities.
     *
     * @Route("/", name="admin_ref_shipping_methods")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminReferenceBundle:ShippingMethods')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     *
     * @Route("/new", name="admin_ref_shipping_methods_new")
     * @Template()
     */
    public function newAction(Request $request){

        $shippingMethods = new ShippingMethods();
        $form = $this->createForm('RleeCMS\ReferenceBundle\Form\ShippingMethodsType',$shippingMethods);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($shippingMethods);
            $em->flush();
            return $this->redirectToRoute('admin_ref_shipping_methods');
        }
        return array(
          'form' => $form->createView()
        );

    }
    /**
     *
     * @Route("/edit/{id}", name="admin_ref_shipping_methods_edit")
     * @Template()
     */
    public function editAction(Request $request,ShippingMethods $shippingMethods){

        $form = $this->createForm('RleeCMS\ReferenceBundle\Form\ShippingMethodsType',$shippingMethods);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($shippingMethods);
            $em->flush();
            return $this->redirectToRoute('admin_ref_shipping_methods');
        }
        return array(
          'form' => $form->createView()
        );

    }

    /**
     *
     * @Route("/delete/{id}", name="admin_ref_shipping_methods_delete")
     * @Template()
     */
    public function deleteAction(Request $request,ShippingMethods $shippingMethods){

            $em = $this->getDoctrine()->getManager();
            $em->remove($shippingMethods);
            $em->flush();
            return $this->redirectToRoute('admin_ref_shipping_methods');


    }
}
