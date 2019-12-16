<?php

namespace RleeCMS\ShopBundle\Controller\Admin\Settings;

use RleeCMS\ShopBundle\Entity\Filters;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Form\Settings\FiltersType;

/**
 * Country controller.
 *
 * @Route("/filters")
 */
class FiltersController extends Controller
{
    /**
     * Lists all Filter entities.
     *
     * @Route("/", name="admin_shop_settings_filter")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $filters = $this->getDoctrine()
            ->getRepository('RleeCMSShopBundle:Filters')->findAll();

        return array(
            'filters' => $filters,
        );
    }

    /**
     * Creates a new Filters entity.
     *
     * @Route("/new", name="admin_shop_settings_filter_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $filter = new Filters();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\Settings\FiltersType', $filter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filter);
            $em->flush();

            return $this->redirectToRoute('admin_shop_settings_filter');
        }

        return array(
            'filter' => $filter,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Filters entity.
     *
     * @Route("/{id}/edit", name="admin_shop_settings_filter_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Filters $filter)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\Settings\FiltersType', $filter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filter);
            $em->flush();

            return $this->redirectToRoute('admin_shop_settings_filter');
        }

        return array(
            'filter' => $filter,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Filters entity.
     *
     * @Route("/{id}/delete", name="admin_shop_settings_filter_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $filter = $em->getRepository('RleeCMSShopBundle:Filters')->find($id);

        if (!$filter) {
            throw $this->createNotFoundException('Unable to find Filters entity.');
        }

        $em->remove($filter);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_settings_filter'));
    }
}
