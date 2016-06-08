<?php

namespace RleeCMS\ShopBundle\Controller\Admin\Settings;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\Country;
use RleeCMS\ShopBundle\Form\Settings\CountryType;

/**
 * Country controller.
 *
 * @Route("/country")
 */
class CountryController extends Controller
{
    /**
     * Lists all Country entities.
     *
     * @Route("/", name="admin_shop_settings_country")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $countries = $this->getDoctrine()
            ->getRepository('RleeCMSShopBundle:Country')
            ->createQueryBuilder('c')
            ->orderBy('c.root')
            ->getQuery()->getResult();

        return array(
            'countries' => $countries,
        );
    }

    /**
     * Creates a new Country entity.
     *
     * @Route("/new", name="admin_shop_settings_country_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $country = new Country();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\Settings\CountryType', $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute('admin_shop_settings_country');
        }

        return array(
            'country' => $country,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Country entity.
     *
     * @Route("/{id}/edit", name="admin_shop_settings_country_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Country $country)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\Settings\CountryType', $country);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute('admin_shop_settings_country');
        }

        return array(
            'country' => $country,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Country entity.
     *
     * @Route("/{id}/delete", name="admin_shop_settings_country_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('RleeCMSShopBundle:Country')->find($id);

        if (!$country) {
            throw $this->createNotFoundException('Unable to find Country entity.');
        }

        $em->remove($country);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_settings_country'));
    }
}
