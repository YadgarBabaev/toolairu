<?php

namespace RleeCMS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function indexAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        // Simple example
        $breadcrumbs->addItem("Home", $this->get("router")->generate("admin"));

        // Example without URL
        $breadcrumbs->addItem("Some text without link");


        return $this->render('RleeCMSAdminBundle:Default:index.html.twig');
    }
}
