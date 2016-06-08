<?php

namespace RleeCMS\ShopBundle\Controller\Site;

use RleeCMS\ShopBundle\Entity\Feedback;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Feedback controller.
 *
 *
 */
class FeedbackController extends Controller
{
    /**
     * Route("/", name="site_feedback")
     */
    public function indexAction(Request $request, $alias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);
        $translator = $this->get('translator');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdminCMSBundle:Menu');
        /** @var  $menu \RleeCMS\CMSBundle\Entity\Menu */
        $menu = $repository->findOneBy(array('alias' => $alias, 'status' => 1));

        if (!$menu) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        if (!$menu->getHome()) {
            $breadcrumbs = $this->get("white_october_breadcrumbs");
            // Simple example
            $breadcrumbs->addItem('Home', $this->generateUrl('site_index'));
            $breadcrumbs->addItem($menu->getTitle());
        }

        $feedback = new Feedback();
        $form = $this->createForm('RleeCMS\ShopBundle\Form\FeedbackType', $feedback);
        $form->handleRequest($request);
//        var_dump($request->headers->get('referer').'?flag=true');die;
        if ($form->isSubmitted() && $form->isValid()) {
            $feedback->setCreated(new \DateTime());
            $em->persist($feedback);
            $em->flush();

            $settings = $this->getDoctrine()->getRepository('UserBundle:Settings')->find(1);
            if ($settings) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($translator->trans('MESSAGE IN FEEDBACK'))
                    ->setFrom('toolai.fashion@gmail.com')
                    ->setTo($settings->getEmail())
                    ->setBody($this->renderView('RleeCMSShopBundle:Site:Feedback\message.html.twig',
                        array(
                            'entity' => $feedback
                        ),
                        'text/html'
                    ))
                    ->setContentType("text/html");
                $this->get('mailer')->send($message);
//                die;
            }

            return $this->redirect($request->headers->get('referer') . '?flag=true');
        }
        $flag = $request->query->get('flag', false);

        return $this->render('RleeCMSShopBundle:Site:Feedback\index.html.twig', array(
            'form' => $form->createView(),
            'menu' => $menu,
            'flag' => $flag
        ));
    }
}