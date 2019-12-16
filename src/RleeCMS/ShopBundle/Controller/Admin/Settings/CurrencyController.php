<?php

namespace RleeCMS\ShopBundle\Controller\Admin\Settings;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\Currency;
use RleeCMS\ShopBundle\Form\Settings\CurrencyType;

/**
 * Currency controller.
 *
 * @Route("/currency")
 */
class CurrencyController extends Controller
{
    /**
     * Lists all Currency entities.
     *
     * @Route("/", name="admin_shop_settings_currency")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $currencies = $em->getRepository('RleeCMSShopBundle:Currency')->findAll();

        return array(
            'currencies' => $currencies,
        );
    }

    /**
     * Creates a new Currency entity.
     *
     * @Route("/new", name="admin_shop_settings_currency_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $mainCurrency = $em->getRepository('RleeCMSShopBundle:Currency')->findOneBy(array(
            'main' => 1,
            'status' => 1
        ));
        $main = 0;
        if ($mainCurrency) {
            $main = 1;
        }
        $currency = new Currency();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\Settings\CurrencyType', $currency);

        $currencyAll = $em->getRepository('RleeCMSShopBundle:Currency')->findAll();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->get('currency');
            $dataMain = $data['mainTab'];
            if (isset($dataMain['main'])) {
                if ($mainCurrency) {
                    $k = $mainCurrency->getRate() / $dataMain['rate_for_main'];
                    foreach ($currencyAll as $currencyObj) {
                        if ($mainCurrency->getId() == $currencyObj->getId()) {
                            $currencyObj->setRate($dataMain['rate_for_main']);
                            $currencyObj->setMain(0);
                        } else {
                            $currencyObj->setRate(round($currencyObj->getRate() * $k, 2));
                        }
                        $em->persist($currencyObj);
                    }
                } else {
                    $currency->setMain(1);
                }
                $currency->setRate(1);
            } else {
                $currency->setMain(0);
                $currency->setRate($dataMain['rate']);
            }

            $em->persist($currency);
            $em->flush();

            return $this->redirectToRoute('admin_shop_settings_currency');
        }

        return array(
            'currency' => $currency,
            'form' => $form->createView(),
            'main' => $main,
        );
    }

    /**
     * Displays a form to edit an existing Currency entity.
     *
     * @Route("/{id}/edit", name="admin_shop_settings_currency_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Currency $currency)
    {
        $em = $this->getDoctrine()->getManager();
        $mainCurrency = $em->getRepository('RleeCMSShopBundle:Currency')->findOneBy(array(
            'main' => 1,
            'status' => 1
        ));
        $main = 0;
        $equal = 0;
        if ($mainCurrency) {
            $main = 1;
            if ($mainCurrency->getId() == $currency->getId()) {
                $equal = 1;
            }
        }
        $currencyAll = $em->getRepository('RleeCMSShopBundle:Currency')->findAll();

        $editForm = $this->createForm('RleeCMS\ShopBundle\Form\Settings\CurrencyType', $currency);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $data = $request->request->get('currency');
            $dataMain = $data['mainTab'];
            if (isset($dataMain['main'])) {
                if ($equal == 1) {
                    $currency->setMain(1);
                    $currency->setRate(1);
                } else {
                    if ($mainCurrency) {
                        foreach ($currencyAll as $currencyObj) {
                            if ($currencyObj->getId() != $currency->getId()) {
                                if ($mainCurrency->getId() == $currencyObj->getId()) {
                                    $currencyObj->setRate($dataMain['rate_for_main']);
                                    $currencyObj->setMain(0);
                                } else {
                                    $currencyObj->setRate(round($currencyObj->getRate() * $dataMain['rate_for_main'], 2));
                                }
                                $em->persist($currencyObj);
                            }
                        }
                    } else {
                        $currency->setMain(1);
                    }
                    $currency->setRate(1);
                }
            } else {
                $currency->setMain(0);
                $currency->setRate($dataMain['rate']);
            }

            $em->persist($currency);
            $em->flush();

            return $this->redirectToRoute('admin_shop_settings_currency');
        }

        return array(
            'currency' => $currency,
            'edit_form' => $editForm->createView(),
            'main' => $main,
            'equal' => $equal,
        );
    }

    /**
     * Deletes a Currency entity.
     *
     * @Route("/{id}/delete", name="admin_shop_settings_currency_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $currency = $em->getRepository('RleeCMSShopBundle:Currency')->find($id);

        if (!$currency or $currency->getMain()) {
            throw $this->createNotFoundException('Unable to find Currency entity.');
        }

        $em->remove($currency);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_shop_settings_currency'));
    }
}
