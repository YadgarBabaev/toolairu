<?php

namespace XpatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



abstract class XPatController extends Controller
{
    protected $entity;

    protected $repository;

    protected $routePrefix;

    protected $refName;

    protected $formType = 'XpatBundle\Form\SimpleRefType';

    protected $viewDirectory = 'XpatBundle:XPat';


    abstract function indexAction();

    protected function index(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository($this->repository)->findAll();

        return $this->render($this->viewDirectory.':index.html.twig', array(
            'entities' => $entities,
            'prefix' => $this->routePrefix,
            'refName' => $this->refName
        ));
    }


    abstract function newAction(Request $request);

    protected function newEntity(Request $request)
    {
        $entity = $this->entity;
        $form = $this->createForm($this->formType, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute($this->routePrefix.'index');
        }

        return $this->render($this->viewDirectory.':new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'prefix' => $this->routePrefix,
            'refName' => $this->refName
        ));
    }


    abstract function editAction(Request $request, $entity);

    public function edit(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository($this->repository)->find($id);
        if(!$entity){
            throw  $this->createNotFoundException('Запись не найдена');
        }
        $editForm = $this->createForm($this->formType, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute($this->routePrefix.'index');
        }

        return $this->render($this->viewDirectory.':edit.html.twig', array(
            'entity' => $entity,
            'form' => $editForm->createView(),
            'prefix' => $this->routePrefix,
            'refName' => $this->refName
        ));
    }

    abstract function deleteAction(Request $request, $entity);

    public function delete(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository($this->repository)->find($id);
        if(!$entity){
            throw  $this->createNotFoundException('Запись не найдена');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute($this->routePrefix.'index');
    }
}
