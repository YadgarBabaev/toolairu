<?php

namespace RleeCMS\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\CMSBundle\Entity\Pages;
use RleeCMS\CMSBundle\Form\PagesType;

/**
 * Pages controller.
 *
 * @Route("/pages")
 */
class PagesController extends Controller
{

    /**
     * Lists all Pages entities.
     *
     * @Route("/", name="admin_cms_pages")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminCMSBundle:Pages')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pages entity.
     *
     * @Route("/create", name="admin_cms_pages_create")
     * @Method("POST")
     * @Template("AdminCMSBundle:Pages:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pages();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $hide = $form->get('hide')->getData();
//            if ($hide) {
                $params['hide'] = $hide;
                $entity->setParams($params);
//            }
            $entity->setCreated(new \DateTime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cms_pages'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pages entity.
     *
     * @param Pages $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pages $entity)
    {
        $form = $this->createForm(PagesType::class, $entity, array(
            'action' => $this->generateUrl('admin_cms_pages_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pages entity.
     *
     * @Route("/new", name="admin_cms_pages_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pages();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pages entity.
     *
     * @Route("/{id}", name="admin_cms_pages_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pages entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Pages entity.
     *
     * @Route("/{id}/edit", name="admin_cms_pages_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pages entity.');
        }

        $editForm = $this->createEditForm($entity);
//        var_dump($entity->getParams());die;

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'params' => $entity->getParams(),
        );
    }

    /**
    * Creates a form to edit a Pages entity.
    *
    * @param Pages $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pages $entity)
    {
        $form = $this->createForm(PagesType::class, $entity, array(
            'action' => $this->generateUrl('admin_cms_pages_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pages entity.
     *
     * @Route("/{id}/update", name="admin_cms_pages_update")
     * @Method("PUT")
     * @Template("AdminCMSBundle:Pages:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pages entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setUpdateDate(new \DateTime());
            $hide = $editForm->get('hide')->getData();
//            if ($hide) {
                $params['hide'] = $hide;
                $entity->setParams($params);
//            }
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cms_pages'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Pages entity.
     *
     * @Route("/{id}/delete", name="admin_cms_pages_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminCMSBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pages entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_cms_pages'));
    }

    /**
     * Status a Pages entity.
     *
     * @Route("/{id}/status", name="admin_cms_pages_status")
     */
    public function statusAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminCMSBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pages entity.');
        }
        /** @var $entity \RleeCMS\CMSBundle\Entity\Pages */
        if ($entity->getStatus() == 1) {
            $entity->setStatus(0);
        } else {
            $entity->setStatus(1);
        }
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_cms_pages'));
    }
}
