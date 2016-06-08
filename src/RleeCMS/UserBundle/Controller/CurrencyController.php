<?php

namespace RleeCMS\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LegalPersonController
 * @Route("/currency")
 */
class CurrencyController extends Controller
{
    /**
     * @Route("/set",name="currency_index")
     * @Template()
     */
    public function indexAction(Request $request){

        $session = $request->getSession();
        if($request->get('id')>0){
            $session->set('currency',$request->get('id'));
            return $this->redirectToRoute('index');
        }
        $currentCurrency = $session->get('currency');
        $currencies = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Currency')->findAll();
       return array(
           'currencies' => $currencies,
           'current'    => $currentCurrency
       );

    }
}
