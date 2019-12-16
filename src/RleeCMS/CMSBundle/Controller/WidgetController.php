<?php

namespace RleeCMS\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\CMSBundle\Entity\Widget;
use RleeCMS\CMSBundle\Form\WidgetType;

/**
 * Widget controller.
 *
 * @Route("/widget")
 */
class WidgetController extends Controller
{

    /**
     * Lists all Widget entities.
     *
     * @Route("/", name="admin_cms_widget")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminCMSBundle:Widget')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Widget entity.
     *
     * @Route("/create", name="admin_cms_widget_create")
     * @Method("POST")
     * @Template("AdminCMSBundle:Widget:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Widget();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Параметры типа меню
            $hideMenu = $form->get('hideMenu')->getData();
            if ($hideMenu) {
                $hideMenu = $hideMenu->getId();
            }
            $params['MenuType'] = $hideMenu;
            // Параметры типа слайдер
            $hideSliderCount = $form->get('hideSliderCount')->getData();
            $hideSliderSpeed = $form->get('hideSliderSpeed')->getData();
            $hideSliderTitle = $form->get('hideSliderTitle')->getData();
            $hideSliderHref = $form->get('hideSliderHref')->getData();
            $params['SliderCount'] = $hideSliderCount;
            $params['SliderSpeed'] = $hideSliderSpeed;
            $params['SliderTitle'] = $hideSliderTitle;
            $params['SliderHref'] = $hideSliderHref;
            // Параметры типа каталог
            $hideCategory = $form->get('hideCategory')->getData();
            if ($hideCategory) {
                $hideCategory = $hideCategory->getId();
            }
            $hideCategoryHref = $form->get('hideCategoryHref')->getData();
            $params['Category'] = $hideCategory;
            $params['CategoryHref'] = $hideCategoryHref;
            // Параметры типа товар
            $hideProduct = $form->get('hideProduct')->getData();
            if ($hideProduct) {
                $hideProduct = $hideProduct->getId();
            }
            $hideProductHref = $form->get('hideProductHref')->getData();
            $params['Product'] = $hideProduct;
            $params['ProductHref'] = $hideProductHref;

            $entity->setParams($params);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cms_widget'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Widget entity.
     *
     * @param Widget $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Widget $entity)
    {
        $form = $this->createForm(WidgetType::class, $entity, array(
            'action' => $this->generateUrl('admin_cms_widget_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Widget entity.
     *
     * @Route("/new", name="admin_cms_widget_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Widget();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Widget entity.
     *
     * @Route("/{id}", name="admin_cms_widget_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Widget')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Widget entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Widget entity.
     *
     * @Route("/{id}/edit", name="admin_cms_widget_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Widget')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Widget entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'params' => $entity->getParams(),
        );
    }

    /**
    * Creates a form to edit a Widget entity.
    *
    * @param Widget $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Widget $entity)
    {
        $form = $this->createForm(WidgetType::class, $entity, array(
            'action' => $this->generateUrl('admin_cms_widget_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Widget entity.
     *
     * @Route("/{id}/update", name="admin_cms_widget_update")
     * @Method("PUT")
     * @Template("AdminCMSBundle:Widget:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Widget')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Widget entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            // Параметры типа меню
            $hideMenu = $editForm->get('hideMenu')->getData();
            if ($hideMenu) {
                $hideMenu = $hideMenu->getId();
            }
            $params['MenuType'] = $hideMenu;
            // Параметры типа слайдер
            $hideSliderCount = $editForm->get('hideSliderCount')->getData();
            $hideSliderSpeed = $editForm->get('hideSliderSpeed')->getData();
            $hideSliderTitle = $editForm->get('hideSliderTitle')->getData();
            $hideSliderHref = $editForm->get('hideSliderHref')->getData();
            $params['SliderCount'] = $hideSliderCount;
            $params['SliderSpeed'] = $hideSliderSpeed;
            $params['SliderTitle'] = $hideSliderTitle;
            $params['SliderHref'] = $hideSliderHref;
            // Параметры типа каталог
            $hideCategory = $editForm->get('hideCategory')->getData();
            if ($hideCategory) {
                $hideCategory = $hideCategory->getId();
            }
            $hideCategoryHref = $editForm->get('hideCategoryHref')->getData();
            $params['Category'] = $hideCategory;
            $params['CategoryHref'] = $hideCategoryHref;
            // Параметры типа товар
            $hideProduct = $editForm->get('hideProduct')->getData();
            if ($hideProduct) {
                $hideProduct = $hideProduct->getId();
            }
            $hideProductHref = $editForm->get('hideProductHref')->getData();
            $params['Product'] = $hideProduct;
            $params['ProductHref'] = $hideProductHref;

            $entity->setParams($params);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cms_widget'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a Widget entity.
     *
     * @Route("/{id}/delete", name="admin_cms_widget_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminCMSBundle:Widget')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Widget entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_cms_widget'));
    }

    /**
     * Status a Widget entity.
     *
     * @Route("/{id}/status", name="admin_cms_widget_status")
     */
    public function statusAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminCMSBundle:Widget')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Widget entity.');
        }
        /** @var $entity \RleeCMS\CMSBundle\Entity\Widget */
        if ($entity->getStatus() == 1) {
            $entity->setStatus(0);
        } else {
            $entity->setStatus(1);
        }
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_cms_widget'));
    }
}
