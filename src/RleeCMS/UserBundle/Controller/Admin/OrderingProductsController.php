<?php

namespace RleeCMS\UserBundle\Controller\Admin;

use RleeCMS\UserBundle\Entity\OrderingProducts;
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
 * @Route("/admin/ordering_products")
 */
class OrderingProductsController extends Controller
{

    /**
     * Lists all Status entities.
     *
     * @Route("/new/{id}", name="admin_ordering_products_new")
     * @Template()
     */
    public function newAction(Request $request, Orders $order)
    {
        $orderingProduct = new OrderingProducts();
        $form = $this->createForm('RleeCMS\UserBundle\Form\OrderingProductsType', $orderingProduct);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($orderingProduct);
            $order->addProduct($orderingProduct);
            $em->persist($order);
            $em->flush();
            return $this->redirectToRoute('admin_order_show',array('id'=>$order->getId()));
        }
        return array(
            'orderingProduct' => $orderingProduct,
            'form' => $form->createView(),
            'id_order' => $order->getId()
        );

    }
    /**
     * Lists all Status entities.
     *
     * @Route("/edit/{id}/{id_order}", name="admin_ordering_products_edit")
     * @Template()
     */
    public function editAction(Request $request,OrderingProducts $op, $id_order)
    {
        $form = $this->createForm('RleeCMS\UserBundle\Form\OrderingProductsType', $op );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $em = $this->getDoctrine()->getManager();
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('admin_order_show',array('id'=>$id_order));
        }
        return array(
            'order' => $op,
            'form' => $form->createView(),
            'id_order' => $id_order
            );

    }

    /**
     * @Route("/delete/{id}/{id_order}", name="admin_ordering_products_delete")
     */
    public function deleteAction(OrderingProducts $orderingProduct , $id_order){
        $em = $this->getDoctrine()->getManager();
        $order = $this->getDoctrine()->getRepository('UserBundle:Orders')->find($id_order);
        $order->removeProduct($orderingProduct);
        $em->remove($orderingProduct);
        $em->flush();
        return $this->redirectToRoute('admin_order_show',array('id'=> $id_order));
    }

}