<?php

namespace RleeCMS\ShopBundle\Controller\Admin\Settings;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\SliderImage;
use RleeCMS\ShopBundle\Form\Settings\SliderImageType;

/**
 * SliderImage controller.
 *
 * @Route("/sliderimage")
 */
class SliderImageController extends Controller
{
    /**
     * Lists all SliderImage entities.
     *
     * @Route("/", name="admin_shop_settings_sliderimage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sliderImages = $em->getRepository('RleeCMSShopBundle:SliderImage')->findAll();

        return array(
            'sliderImages' => $sliderImages,
        );
    }

    /**
     * Creates a new SliderImage entity.
     *
     * @Route("/new", name="admin_shop_settings_sliderimage_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $sliderImage = new SliderImage();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\Settings\SliderImageType', $sliderImage, array('flag'=> true));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sliderImage);
            $em->flush();

            return $this->redirectToRoute('admin_shop_settings_sliderimage');
        }

        return array(
            'sliderImage' => $sliderImage,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SliderImage entity.
     *
     * @Route("/{id}/edit", name="admin_shop_settings_sliderimage_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, SliderImage $sliderImage)
    {
        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\Settings\SliderImageType', $sliderImage, array('flag'=> false));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sliderImage);
            $em->flush();

            return $this->redirectToRoute('admin_shop_settings_sliderimage');
        }

        return array(
            'sliderImage' => $sliderImage,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a SliderImage entity.
     *
     * @Route("/{id}/delete", name="admin_shop_settings_sliderimage_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sliderImage = $em->getRepository('RleeCMSShopBundle:SliderImage')->find($id);

        if (!$sliderImage) {
            throw $this->createNotFoundException('Unable to find SliderImage entity.');
        }

        $em->remove($sliderImage);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_settings_sliderimage'));
    }
}
