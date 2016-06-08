<?php

namespace RleeCMS\ShopBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\Color;
use RleeCMS\ShopBundle\Form\ColorType;

/**
 * Color controller.
 *
 * @Route("/color")
 */
class ColorController extends Controller
{
    /**
     * Lists all Color entities.
     *
     * @Route("/", name="admin_shop_color")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $colors = $em->getRepository('RleeCMSShopBundle:Color')->findAll();

        return array(
            'colors' => $colors,
        );
    }

    /**
     * Creates a new Color entity.
     *
     * @Route("/new", name="admin_shop_color_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $color = new Color();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\ColorType', $color, array('flag'=> true));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($color);
            $em->flush();

            return $this->redirectToRoute('admin_shop_color');
        }

        return array(
            'color' => $color,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Color entity.
     *
     * @Route("/{id}/edit", name="admin_shop_color_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Color $color)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\ColorType', $color, array('flag'=> true));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($color);
            $em->flush();

            return $this->redirectToRoute('admin_shop_color');
        }

        return array(
            'color' => $color,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Color entity.
     *
     * @Route("/{id}/delete", name="admin_shop_color_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $color = $em->getRepository('RleeCMSShopBundle:Color')->find($id);

        if (!$color) {
            throw $this->createNotFoundException('Unable to find Color entity.');
        }

        $em->remove($color);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_color'));
    }
}
