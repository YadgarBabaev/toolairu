<?php

namespace RleeCMS\ShopBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RleeCMS\ShopBundle\Entity\ShopByLook;
use RleeCMS\ShopBundle\Form\ShopByLookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * ShopByLook controller.
 *
 * @Route("/shopbylook")
 */
class ShopByLookController extends Controller
{
    /**
     * Lists all ShopByLook entities.
     *
     * @Route("/{id}", name="admin_shop_shop_by_look")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('RleeCMSShopBundle:Category')->find($id);
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $shopByLooks = $em->getRepository('RleeCMSShopBundle:ShopByLook')->findBy(array(
            'category' => $category->getId()
        ));

        return array(
            'category' => $category,
            'shopByLooks' => $shopByLooks,
        );
    }

    /**
     * Creates a new ShopByLook entity.
     *
     * @Route("/new/{id}", name="admin_shop_shop_by_look_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('RleeCMSShopBundle:Category')->find($id);
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $shopByLook = new ShopByLook();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\ShopByLookType', $shopByLook, array('flag' => true, 'cId' => $category->getId()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shopByLook->setCategory($category);
            $em->persist($shopByLook);
            $em->flush();

            return $this->redirectToRoute('admin_shop_shop_by_look', array('id' => $id));
        }

        return array(
            'category' => $category,
            'shopByLook' => $shopByLook,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ShopByLook entity.
     *
     * @Route("/{id}/edit", name="admin_shop_shop_by_look_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, ShopByLook $shopByLook)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\ShopByLookType', $shopByLook, array(
            'flag' => false,
            'cId' => $shopByLook->getCategory()->getId()
        ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shopByLook);
            $em->flush();

            return $this->redirectToRoute('admin_shop_shop_by_look', array('id' => $shopByLook->getCategory()->getId()));
        }

        return array(
            'shopByLook' => $shopByLook,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a ShopByLook entity.
     *
     * @Route("/{id}/delete", name="admin_shop_shop_by_look_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $shopByLook = $em->getRepository('RleeCMSShopBundle:ShopByLook')->find($id);

        if (!$shopByLook) {
            throw $this->createNotFoundException('Unable to find ShopByLook entity.');
        }
        $categoryId = $shopByLook->getCategory()->getId();

        $em->remove($shopByLook);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_shop_by_look', array('id' => $categoryId)));
    }
}
