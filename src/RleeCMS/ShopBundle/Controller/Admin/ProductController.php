<?php

namespace RleeCMS\ShopBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\Product;
use RleeCMS\ShopBundle\Form\ProductType;

/**
 * Product controller.
 *
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * Lists all Product entities.
     *
     * @Route("/", name="admin_shop_product")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('RleeCMSShopBundle:Product')->findAll();

        return array(
            'products' => $products,
        );
    }

    /**
     * Creates a new Product entity.
     *
     * @Route("/new", name="admin_shop_product_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\ProductType', $product, array('flag'=> true));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('admin_shop_product');
        }

        return array(
            'product' => $product,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     * @Route("/{id}/edit", name="admin_shop_product_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Product $product)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\ProductType', $product, array('flag'=> false));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('admin_shop_product');
        }

        return array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Product entity.
     *
     * @Route("/{id}/delete", name="admin_shop_product_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('RleeCMSShopBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $em->remove($product);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_product'));
    }
}
