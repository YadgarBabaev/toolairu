<?php

namespace Site\CMSBundle\Service;

use Symfony\Component\DependencyInjection\Container;

class MenuService
{
    private $doctrine;
    private $container;
    private $menuRepository;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->doctrine = $this->container->get('doctrine');
        $this->menuRepository = $this->doctrine->getRepository('AdminCMSBundle:Menu');
    }

    public function getMainMenu($id)
    {

        return $this->menuRepository->findBy(
            array('menuType' => $id, 'status' => 1),
            array('orderning'=>'ASC', 'id'=>'DESC'));
    }
}