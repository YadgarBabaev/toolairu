<?php

namespace RleeCMS\UserBundle\Controller\Admin;

use Doctrine\ORM\QueryBuilder;
use RleeCMS\UserBundle\Entity\LegalPerson;
use RleeCMS\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ReferenceBundle\Entity\Status;
use RleeCMS\ReferenceBundle\Form\StatusType;

/**
 * Status controller.
 *
 * @Route("/admin/user")
 */
class IndexController extends Controller
{
    /**
     * Lists all Status entities.
     *
     * @Route("/", name="admin_user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
//        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
//        $userManager = $this->container->get('fos_user.user_manager');
//        /** @var User $users */
//        $users = $userManager->findUsers();
        /** @var QueryBuilder $qb */
        $qb = $this->getDoctrine()->getRepository('UserBundle:User')->createQueryBuilder('u');
        $type = $request->get('type');
        $keyword = $request->get('keyword');
        $qb->where('1=1');
        if($keyword != null){
            $qb->andWhere('(u.username LIKE :keyword OR u.name LIKE :keyword OR u.fName LIKE :keyword)')
                ->setParameter('keyword','%'.$keyword.'%');
        }
        if($type == 1){
            $qb->join('u.legal_person','lp');
            $qb->andWhere('lp.id IS NOT NULL');
        }
        if($type == 2){
            $qb->leftJoin('u.legal_person','lp');
            $qb->andWhere('lp.id IS  NULL');
        }
        $users = $qb->getQuery()->getResult();
        return (array('users' => $users));

    }

    /**
     * Lists all Status entities.
     *
     * @Route("/edit/{id}", name="admin_user_edit")
     * @Template()
     */
    public function editAction(Request $request,User $user)
    {
        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->container->get('fos_user.user_manager');
        $person = $user->getLegalPerson();
        if($person){
            $user->getLegalPerson()->setRoles($user->getRoles());
            $person = $user->getLegalPerson();
            $form = $this->createForm('RleeCMS\UserBundle\Form\LegalPersonAdminType', $person,array(
                'user' => $user
            ));
        }else{
            $form = $this->createForm('RleeCMS\UserBundle\Form\UserType', $user);   
        }
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($person){
                $user->setUsername($person->getEmail());
                $user->setName($person->getCompanyName());
                $user->setfName($person->getFio());
                $user->setNews($person->isNews());
                $user->setEmail($person->getEmail());
                $user->setRoles($person->getRoles());
                if($person->getPlainPassword()){
                    $user->setPlainPassword($person->getPlainPassword());
                }
                $person->setUsername($person->getEmail());
                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush();
            }
            $userManager->updateUser($user);
            return $this->redirectToRoute('admin_user');
        }
        return array(
            'user' => $user,
            'form' => $form->createView()
            );

    }

    /**
     * Lists all Status entities.
     *
     * @Route("/new", name="admin_user_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $type = $request->get('type');
        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $person = new LegalPerson();
        if($type == 1){
            $form = $this->createForm('RleeCMS\UserBundle\Form\LegalPersonAdminType', $person,array(
                'user' => $user,
                'action' => $this->generateUrl('admin_user_new',array('type'=>1))
            ));
        }else{
            $form = $this->createForm('RleeCMS\UserBundle\Form\UserType', $user);
        }
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if( $type ==1 ){
                $user->setUsername($person->getEmail());
                $user->setName($person->getCompanyName());
                $user->setfName($person->getFio());
                $user->setNews($person->isNews());
                $user->setEmail($person->getEmail());
                $user->setRoles($person->getRoles());
                if($person->getPlainPassword()){
                    $user->setPlainPassword($person->getPlainPassword());
                }
                $person->setUser($user);
                $person->setUsername($person->getEmail());
                $em = $this->getDoctrine()->getManager();
                $user->setEnabled(true);
                $userManager->updateUser($user);
                $em->persist($person);
                $em->flush();
            }else{
                $userManager->updateUser($user);
            }
            return $this->redirectToRoute('admin_user');
        }
        return array(
            'user' => $user,
            'form' => $form->createView()
            );

    }

    /**
     * @Route("/delete/{id}", name="admin_user_delete")
     */
    public function deleteAction(User $user){
        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->container->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getManager();
        $person = $this->getDoctrine()->getRepository('UserBundle:LegalPerson')->findOneBy(
            array(
                'user'=> $user->getId()
            )
        );
        if($person){
            $em->remove($person);
            $em->flush();
        }
        $userManager->deleteUser($user);
        return $this->redirectToRoute('admin_user');
    }

}