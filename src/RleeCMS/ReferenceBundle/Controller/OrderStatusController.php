<?php

namespace RleeCMS\ReferenceBundle\Controller;

use RleeCMS\ReferenceBundle\Entity\OrderStatus;
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
 * @Route("/order_status")
 */
class OrderStatusController extends Controller
{

    /**
     * Lists all Status entities.
     *
     * @Route("/", name="admin_ref_order_status")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminReferenceBundle:OrderStatus')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     *
     * @Route("/new", name="admin_ref_order_status_new")
     * @Template()
     */
    public function newAction(Request $request){

        $entity = new OrderStatus();
        $form = $this->createForm('RleeCMS\ReferenceBundle\Form\OrderStatusType',$entity);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirectToRoute('admin_ref_order_status');
        }
        return array(
          'form' => $form->createView()
        );

    }
    /**
     *
     * @Route("/edit/{id}", name="admin_ref_order_status_edit")
     * @Template()
     */
    public function editAction(Request $request,OrderStatus $entity){

        $form = $this->createForm('RleeCMS\ReferenceBundle\Form\OrderStatusType',$entity);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirectToRoute('admin_ref_order_status');
        }
        return array(
          'form' => $form->createView()
        );

    }

    /**
     *
     * @Route("/delete/{id}", name="admin_ref_order_status_delete")
     * @Template()
     */
    public function deleteAction(Request $request,OrderStatus $entity){

            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return $this->redirectToRoute('admin_ref_order_status');


    }
}
