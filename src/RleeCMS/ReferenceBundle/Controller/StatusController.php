<?php

namespace RleeCMS\ReferenceBundle\Controller;

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
 * @Route("/status")
 */
class StatusController extends Controller
{

    /**
     * Lists all Status entities.
     *
     * @Route("/", name="admin_ref_status")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminReferenceBundle:Status')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Status entity.
     *
     * @Route("/", name="admin_ref_status_create")
     * @Method("POST")
     * @Template("AdminReferenceBundle:Status:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Status();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setDateAdd(new \DateTime('now'));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_ref_status'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Status entity.
     *
     * @param Status $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Status $entity)
    {
        $form = $this->createForm(StatusType::class, $entity, array(
            'action' => $this->generateUrl('admin_ref_status_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Status entity.
     *
     * @Route("/new", name="admin_ref_status_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Status();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Status entity.
     *
     * @Route("/{id}", name="admin_ref_status_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminReferenceBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Status entity.
     *
     * @Route("/{id}/edit", name="admin_ref_status_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminReferenceBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Status entity.
    *
    * @param Status $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Status $entity)
    {
        $form = $this->createForm(StatusType::class, $entity, array(
            'action' => $this->generateUrl('admin_ref_status_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Status entity.
     *
     * @Route("/{id}", name="admin_ref_status_update")
     * @Method("PUT")
     * @Template("AdminReferenceBundle:Status:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminReferenceBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_ref_status'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a Status entity.
     *
     * @Route("/{id}/delete", name="admin_ref_status_delete")
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminReferenceBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_ref_status'));
    }
}
