<?php

namespace RleeCMS\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\CMSBundle\Entity\MenuType;
use RleeCMS\CMSBundle\Form\MenuTypeType;

/**
 * MenuType controller.
 *
 * @Route("/menutype")
 */
class MenuTypeController extends Controller
{

    /**
     * Lists all MenuType entities.
     *
     * @Route("/", name="admin_cms_menutype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminCMSBundle:MenuType')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new MenuType entity.
     *
     * @Route("/create", name="admin_cms_menutype_create")
     * @Method("POST")
     * @Template("AdminCMSBundle:MenuType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new MenuType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cms_menutype'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a MenuType entity.
     *
     * @param MenuType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(MenuType $entity)
    {
        $form = $this->createForm(MenuTypeType::class, $entity, array(
            'action' => $this->generateUrl('admin_cms_menutype_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MenuType entity.
     *
     * @Route("/new", name="admin_cms_menutype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MenuType();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a MenuType entity.
     *
     * @Route("/{id}", name="admin_cms_menutype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:MenuType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MenuType entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing MenuType entity.
     *
     * @Route("/{id}/edit", name="admin_cms_menutype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:MenuType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MenuType entity.');
        }

        $editForm = $this->createEditForm($entity);;

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a MenuType entity.
    *
    * @param MenuType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MenuType $entity)
    {
        $form = $this->createForm(MenuTypeType::class, $entity, array(
            'action' => $this->generateUrl('admin_cms_menutype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MenuType entity.
     *
     * @Route("/{id}", name="admin_cms_menutype_update")
     * @Method("PUT")
     * @Template("AdminCMSBundle:MenuType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:MenuType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MenuType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cms_menutype'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a MenuType entity.
     *
     * @Route("/{id}/delete", name="admin_cms_menutype_delete")
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminCMSBundle:MenuType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MenuType entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_cms_menutype'));
    }
}
