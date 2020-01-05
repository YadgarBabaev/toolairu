<?php

namespace RleeCMS\ShopBundle\Controller\Admin\Category;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\Category;
use RleeCMS\ShopBundle\Form\CategoryType;

/**
 * Trade controller.
 *
 * @Route("/trade")
 */
class TradeController extends Controller
{
    /**
     * Lists all Trade entities.
     *
     * @Route("/", name="admin_shop_category_trade")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('RleeCMSShopBundle:Category')->findBy(array('parent'=>1),array('root'=>'ASC', 'orderning'=>'ASC'));

        return array(
            'categories' => $categories,
        );
    }

    /**
     * Creates a new Trade entity.
     *
     * @Route("/new", name="admin_shop_category_trade_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\CategoryType', $category, array('flag'=> true));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            var_dump($request->request);die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_shop_category_trade');
        }

        return array(
            'category' => $category,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Trade entity.
     *
     * @Route("/{id}/edit", name="admin_shop_category_trade_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Category $category)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\CategoryType', $category, array('flag'=> true));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_shop_category_trade');
        }

        return array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Trade entity.
     *
     * @Route("/{id}/delete", name="admin_shop_category_trade_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('RleeCMSShopBundle:Category')->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $em->remove($category);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_category_trade'));
    }
}
