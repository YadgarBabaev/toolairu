<?php

namespace RleeCMS\CMSBundle\Controller;

use RleeCMS\ShopBundle\Entity\Feedback;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Controller
{
    /**
     * @Route("/", name="admin_cms")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/feedback", name="admin_cms_feedback")
     * @Template()
     */
    public function feedbackAction()
    {
        $entities = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Feedback')->findAll();
        return array(
            'entities' => $entities
        );
    }

    /**
     * @Route("/feedback/delete/{id}", name="admin_cms_feedback_delete")
     * @Template()
     */
    public function feedbackDestroyAction(Feedback $feedback)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($feedback);
        $em->flush();
        return $this->redirectToRoute('admin_cms_feedback');
    }
}
