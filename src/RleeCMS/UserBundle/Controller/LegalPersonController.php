<?php

namespace RleeCMS\UserBundle\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use RleeCMS\UserBundle\Entity\LegalPerson;
use RleeCMS\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LegalPersonController
 * @Route("/legal")
 */
class LegalPersonController extends Controller
{
    /**
     * @Template()
     * @Route("/register",name="legal_register")
     */
    public function registerAction(Request $request){

        $translator = $this->get('translator');
        $legalPerson = new LegalPerson();
        $form = $this->createForm('RleeCMS\UserBundle\Form\LegalPersonType', $legalPerson, array(
            'translator' => $translator
        ));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
            $userManager = $this->container->get('fos_user.user_manager');
            /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
            $dispatcher = $this->get('event_dispatcher');
            $user = $userManager->createUser();
            $event = new GetResponseUserEvent($user, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
            $user->setUsername($legalPerson->getEmail());
            $user->setName($legalPerson->getCompanyName());
            $user->setfName($legalPerson->getFio());
            $user->setNews($legalPerson->isNews());
            $user->setEnabled(true);
            $user->setEmail($legalPerson->getEmail());
            $user->setPlainPassword($legalPerson->getPlainPassword());
            $legalPerson->setUsername($legalPerson->getEmail());

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            $legalPerson->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($legalPerson);
            $em->flush();
            return $response;
        }
        return array(
            'form' => $form->createView()
        );
    }
}
