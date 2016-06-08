<?php

namespace RleeCMS\UserBundle\Controller\Admin;

use RleeCMS\UserBundle\Entity\Orders;
use RleeCMS\UserBundle\Entity\User;
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
 * @Route("/admin/orders")
 */
class OrdersController extends Controller
{
    /**
     * Lists all Status entities.
     *
     * @Route("/", name="admin_orders")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        /** @var Orders $orders */
        $orders = $this->getDoctrine()->getRepository('UserBundle:Orders')->findAll();

        return (array('orders' => $orders));

    }

    /**
     * Lists all Status entities.
     *
     * @Route("/show/{id}", name="admin_order_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Request $request,Orders $order)
    {
        return array(
            'entity' => $order,
        );

    }

    /**
     * Lists all Status entities.
     *
     * @Route("/edit/{id}", name="admin_order_edit")
     * @Template()
     */
    public function editAction(Request $request,Orders $order)
    {

        $form = $this->createForm('RleeCMS\UserBundle\Form\OrdersAdminType', $order);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            return $this->redirectToRoute('admin_orders');
        }
        return array(
            'order' => $order,
            'form' => $form->createView()
            );

    }

    /**
     * @Route("/delete/{id}", name="admin_order_delete")
     */
    public function deleteAction(Orders $order){
        $em = $this->getDoctrine()->getManager();
        $em->remove($order);
        $em->flush();
        return $this->redirectToRoute('admin_orders');
    }

}