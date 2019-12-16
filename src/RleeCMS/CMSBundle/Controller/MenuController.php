<?php

namespace RleeCMS\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\CMSBundle\Entity\Menu;
use RleeCMS\CMSBundle\Form\MenuType;

/**
 * Menu controller.
 *
 * @Route("/menu")
 */
class MenuController extends Controller
{

    /**
     * Lists all Menu entities.
     *
     * @Route("/", name="admin_cms_menu")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminCMSBundle:Menu')->findAll();
        $menuType = array(
            'content' => 'Обычная страница',
            'anchor' => 'Якорь',
            'blog' => 'Блог (новости, статьи)',
            'url' => 'URL',
            'shop'=>'Магазин',
            'collection' => 'Коллекция',
            'b2b' => 'Для Бизнеса',
            'shop_by_look' => 'Shop By Look',
            'feedback' => 'Обратная связь'
        );

        return array(
            'entities' => $entities,
            'menuType' => $menuType,
        );
    }

    /**
     * Creates a new Menu entity.
     *
     * @Route("/create", name="admin_cms_menu_create")
     * @Method("POST")
     * @Template("AdminCMSBundle:Menu:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Menu();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
//            var_dump($entity);die;
            $em->persist($entity);
            $em->flush();
            $this->clearRoute();
            return $this->redirect($this->generateUrl('admin_cms_menu'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Menu entity.
     *
     * @param Menu $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Menu $entity)
    {
        $form = $this->createForm(MenuType::class, $entity, array(
            'action' => $this->generateUrl('admin_cms_menu_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Menu entity.
     *
     * @Route("/new", name="admin_cms_menu_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Menu();
        $form = $this->createCreateForm($entity);
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('RleeCMSShopBundle:Category')->findAll();

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'categories' => $categories,

        );
    }

    /**
     * Finds and displays a Menu entity.
     *
     * @Route("/{id}", name="admin_cms_menu_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Menu entity.
     *
     * @Route("/{id}/edit", name="admin_cms_menu_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }
        $categories = $em->getRepository('RleeCMSShopBundle:Category')->findAll();

        $editForm = $this->createEditForm($entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'categories' => $categories,
        );
    }

    /**
     * Creates a form to edit a Menu entity.
     *
     * @param Menu $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Menu $entity)
    {
        $form = $this->createForm(MenuType::class, $entity, array(
            'action' => $this->generateUrl('admin_cms_menu_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Menu entity.
     *
     * @Route("/{id}/update", name="admin_cms_menu_update")
     * @Method("PUT")
     * @Template("AdminCMSBundle:Menu:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminCMSBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->clearRoute();

            return $this->redirect($this->generateUrl('admin_cms_menu'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Menu entity.
     *
     * @Route("/{id}/delete", name="admin_cms_menu_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminCMSBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $em->remove($entity);
        $em->flush();
        $this->clearRoute();


        return $this->redirect($this->generateUrl('admin_cms_menu'));
    }

    /**
     * Status a Menu entity.
     *
     * @Route("/{id}/status", name="admin_cms_menu_status")
     */
    public function statusAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminCMSBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }
        /** @var $entity \RleeCMS\CMSBundle\Entity\Menu */
        if ($entity->getStatus() == 1) {
            $entity->setStatus(0);
        } else {
            $entity->setStatus(1);
        }
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_cms_menu'));
    }

    /**
     * Home a Menu entity
     * @Route("/{id}/home", name="admin_cms_menu_home")
     */
    public function homeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var $entity \RleeCMS\CMSBundle\Entity\Menu */
        $entity = $em->getRepository('AdminCMSBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }
        if ($entity->getHome()) {
            return $this->redirect($this->generateUrl('admin_cms_menu'));
        }
        $homeMenu = $em->getRepository('AdminCMSBundle:Menu')->findOneBy(array(
            'home' => true
        ));
        if ($homeMenu) {
            $homeMenu->setHome(false);
            $em->persist($homeMenu);
            $em->flush();
        }
        $entity->setHome(true);
        $em->persist($entity);
        $em->flush();
        $this->clearRoute();

        return $this->redirect($this->generateUrl('admin_cms_menu'));
    }

    /**
     * Добавления роута после создания новой страницы
     * @param $page
     * @param $content
     */
    function clearRoute()
    {
        $router = $this->container->get('router');
        $realCacheDir = $this->container->getParameter('kernel.cache_dir');
        $router->warmUp($realCacheDir);
    }
}
