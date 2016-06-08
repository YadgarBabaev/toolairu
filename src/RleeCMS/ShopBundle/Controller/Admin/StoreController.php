<?php

namespace RleeCMS\ShopBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\Store;
use RleeCMS\ShopBundle\Form\StoreType;

/**
 * Store controller.
 *
 * @Route("/store")
 */
class StoreController extends Controller
{
    /**
     * Lists all Store entities.
     *
     * @Route("/", name="admin_shop_store")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stores = $em->getRepository('RleeCMSShopBundle:Store')->findAll();

        return array(
            'stores' => $stores,
        );
    }

    /**
     * Creates a new Store entity.
     *
     * @Route("/new", name="admin_shop_store_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $store = new Store();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\StoreType', $store);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($store);
            $em->flush();

            return $this->redirectToRoute('admin_shop_store');
        }

        return array(
            'store' => $store,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Store entity.
     *
     * @Route("/{id}/edit", name="admin_shop_store_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Store $store)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\StoreType', $store);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($store);
            $em->flush();

            return $this->redirectToRoute('admin_shop_store');
        }

        return array(
            'store' => $store,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Store entity.
     *
     * @Route("/{id}/delete", name="admin_shop_store_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $store = $em->getRepository('RleeCMSShopBundle:Store')->find($id);

        if (!$store) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $em->remove($store);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_store'));
    }
}
