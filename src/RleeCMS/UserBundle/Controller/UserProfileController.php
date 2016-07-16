<?php

namespace RleeCMS\UserBundle\Controller;

use RleeCMS\ShopBundle\Controller\Site\CartController;
use RleeCMS\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserProfileController
 * @package RleeCMS\UserBundle\Controller
 * @Route("/user_profile")
 */
class UserProfileController extends BaseController
{
    /**
     * @Route("/",name="user_profile_index")
     * @Template()
     */
    public function indexAction(){

        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('fos_user_security_login');
        }
        return array(
            'user' => $user
        );
    }

    /**
     * @Route("/edit", name="user_profile_edit")
     * @Template()
     */
    public function editAction(Request $request){
        /** @var User $user */
        $user = $this->getUser();
        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');
        $form = $this->createForm('RleeCMS\UserBundle\Form\ProfileType', $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $userManager->updateUser($user);
            return $this->redirectToRoute('user_profile_index');
        }
        return array(
            'user' => $user,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/orders", name="user_profile_orders")
     * @Template()
     */
    public function ordersAction(Request $request){
        /** @var User $user */
        $user = $this->getUser();
        $orders = $this->getDoctrine()->getRepository('UserBundle:Orders')->findBy(
            array(
                'user' => $user->getId()
            )
        );
        $session = $request->getSession();
        $currency = $this->getDoctrine()->getRepository('RleeCMSShopBundle:Currency')
            ->find(intval($session->get('currency')));

        return array(
            'orders' => $orders,
            'currency'=> $currency,
            'prontoTypes' => CartController::getProntoTypes()
        );

    }
}