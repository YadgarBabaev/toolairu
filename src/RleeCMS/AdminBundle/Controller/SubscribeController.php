<?php

namespace RleeCMS\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\AdminBundle\Entity\Subscribe;
use RleeCMS\AdminBundle\Form\SubscribeType;

/**
 * Subscribe controller.
 *
 * @Route("/subscribe")
 */
class SubscribeController extends Controller
{
    /**
     * Lists all Subscribe entities.
     *
     * @Route("/", name="admin_subscribe")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subscribes = $em->getRepository('RleeCMSAdminBundle:Subscribe')->findAll();
        $type = array(
            'b2b' => 'B2B',
            'b2c' => 'B2C',
        );

        return array(
            'subscribes' => $subscribes,
            'type' => $type
        );
    }

    /**
     * Creates a new Subscribe entity.
     *
     * @Route("/new", name="admin_subscribe_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $subscribe = new Subscribe();
        $form = $this->createForm('RleeCMS\AdminBundle\Form\SubscribeType', $subscribe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $subscribe->setDate(new \DateTime());
            $em->persist($subscribe);
            $em->flush();

            return $this->redirectToRoute('admin_subscribe');
        }

        return array(
            'subscribe' => $subscribe,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Subscribe entity.
     *
     * @Route("/{id}/edit", name="admin_subscribe_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Subscribe $subscribe)
    {
        $editForm = $this->createForm('RleeCMS\AdminBundle\Form\SubscribeType', $subscribe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subscribe);
            $em->flush();

            return $this->redirectToRoute('admin_subscribe');
        }

        return array(
            'subscribe' => $subscribe,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Subscribe entity.
     *
     * @Route("/{id}/delete", name="admin_subscribe_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $subscribe = $em->getRepository('RleeCMSAdminBundle:Subscribe')->find($id);

        if (!$subscribe) {
            throw $this->createNotFoundException('Unable to find Subscribe entity.');
        }

        $em->remove($subscribe);
        $em->flush();


        return $this->redirect($this->generateUrl('admin_subscribe'));
    }

    /**
     * Send a Subscribe entity.
     *
     * @Route("/{id}/send", name="admin_subscribe_send")
     */
    public function sendAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $subscribe = $em->getRepository('RleeCMSAdminBundle:Subscribe')->find($id);

        if (!$subscribe) {
            throw $this->createNotFoundException('Unable to find Subscribe entity.');
        }
        $qb = $em->createQueryBuilder();
        $qb = $qb->select('u.email')
            ->from('UserBundle:User', 'u')
            ->leftJoin('u.legal_person', 'lp')
            ->where('u.enabled = 1')
            ->andWhere('u.news = 1');
        if ($subscribe->getType() == 'b2b') {
            $qb = $qb
                ->andWhere('lp.id IS NOT NULL');
        }
        if ($subscribe->getType() == 'b2c') {
            $qb = $qb
                ->andWhere('lp.id IS NULL');
        }
        $emails = $qb->getQuery()->getResult();
        $emailDb = $this->getDoctrine()->getRepository('RleeCMSAdminBundle:EmailDb')->findBy(array(
            'status' => 1
        ));
        $mail_array = array();
        foreach ($emails as $mail) {
            $mail_array[] = $mail['email'];
        }
        foreach($emailDb as $db){
            $mail_array[] = $db->getName();
        }
        if  (count($mail_array) > 0) {
            $mail_array = array_unique($mail_array);
            foreach ($mail_array as $key => $value) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($subscribe->getTitle())
                    ->setFrom('toolai.fashion@gmail.com')
                    ->setTo($value)
                    ->setBody($this->renderView('RleeCMSAdminBundle:Subscribe:message.html.twig',
                        array(
                            'entity' => $subscribe
                        ),
                        'text/html'
                    ))
                    ->setContentType("text/html");
                $this->get('mailer')->send($message);
            }
        }
        return $this->redirect($this->generateUrl('admin_subscribe'));
    }
}
