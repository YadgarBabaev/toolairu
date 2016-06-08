<?php

namespace RleeCMS\ShopBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\Size;
use RleeCMS\ShopBundle\Form\SizeType;

/**
 * Size controller.
 *
 * @Route("/size")
 */
class SizeController extends Controller
{
    /**
     * Lists all Size entities.
     *
     * @Route("/", name="admin_shop_size")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sizes = $em->getRepository('RleeCMSShopBundle:Size')->findAll();

        return  array(
            'sizes' => $sizes,
        );
    }

    /**
     * Creates a new Size entity.
     *
     * @Route("/new", name="admin_shop_size_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $size = new Size();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\SizeType', $size);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($size);
            $em->flush();

            return $this->redirectToRoute('admin_shop_size');
        }

        return array(
            'size' => $size,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Size entity.
     *
     * @Route("/{id}/edit", name="admin_shop_size_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Size $size)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\SizeType', $size);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($size);
            $em->flush();

            return $this->redirectToRoute('admin_shop_size');
        }

        return array(
            'size' => $size,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Size entity.
     *
     * @Route("/{id}/delete", name="admin_shop_size_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $size = $em->getRepository('RleeCMSShopBundle:Size')->find($id);

        if (!$size) {
            throw $this->createNotFoundException('Unable to find Size entity.');
        }

        $em->remove($size);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_size'));
    }
}
