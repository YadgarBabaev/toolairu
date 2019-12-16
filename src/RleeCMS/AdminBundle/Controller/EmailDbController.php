<?php

namespace RleeCMS\AdminBundle\Controller;

use RleeCMS\AdminBundle\Entity\EmailDb;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use XpatBundle\Controller\XPatController;


/**
 *
 * @Route("/email_db")
 */
class EmailDbController extends XPatController
{
    public function __construct()
    {
        $this->repository = 'RleeCMSAdminBundle:EmailDb';
        $this->entity = new EmailDb();
        $this->routePrefix = 'email_db_';
        $this->refName = 'База email рассылки';
    }

    /**
     *
     * @Route("/", name="email_db_index")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->index();
    }

    /**
     * Creates a new UserRoles entity.
     *
     * @Route("/new", name="email_db_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->newEntity($request);
    }


    /**
     * Displays a form to edit an existing UserRoles entity.
     *
     * @Route("/{id}/edit", name="email_db_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
      return $this->edit($request, $id);
    }

    /**
     * Displays a form to edit an existing UserRoles entity.
     *
     * @Route("/{id}/delete", name="email_db_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, $id)
    {
       return $this->delete($request, $id);
    }


}
