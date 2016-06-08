<?php

namespace RleeCMS\UserBundle\Controller\Admin;

use RleeCMS\UserBundle\Entity\Orders;
use RleeCMS\UserBundle\Entity\Settings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Status controller.
 *
 * @Route("/admin/settings")
 */
class SettingsController extends Controller
{
    /**
     * Lists all Status entities.
     *
     * @Route("/", name="admin_settings")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        /** @var Orders $orders */
        $settings = $this->getDoctrine()->getRepository('UserBundle:Settings')->find(1);
        if(!$settings){
            $settings = new Settings();
            $em = $this->getDoctrine()->getManager();
            $settings->setEmail('mail@example.com');
            $em->persist($settings);
            $em->flush();
        }

        return (array('settings' => $settings));

    }



    /**
     * Lists all Status entities.
     *
     * @Route("/edit/{id}", name="admin_settings_edit")
     * @Template()
     */
    public function editAction(Request $request,Settings $settings)
    {
        $form = $this->createForm('RleeCMS\UserBundle\Form\SettingsType', $settings);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $em = $this->getDoctrine()->getManager();
            $em->persist($settings);
            $em->flush();
            return $this->redirectToRoute('admin_settings');
        }
        return array(
            'settings' => $settings,
            'form' => $form->createView()
            );

    }



}