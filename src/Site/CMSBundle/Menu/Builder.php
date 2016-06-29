<?php

namespace Site\CMSBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', $options['class']);
        $menu->setExtra('currentElement', 'active');
        $menuItems = array();
        if(isset($options['menuType'])){
            $menuItems = $this->container->get('menu')->getMainMenu($options['menuType']);
        }
        $request = $this->container->get('request_stack')->getCurrentRequest();
        foreach($menuItems as $item) {
            /** @var \RleeCMS\CMSBundle\Entity\Menu $item */
            if ($item->getParent()) {
                $em = $this->container->get('doctrine')->getManager();
                $parent = $em->getRepository('AdminCMSBundle:Menu')->find($item->getParent());

                $uri= '/'.$item->getAlias().'.html';
                if($item->getType()=='anchor'){
                    $uri= '/#'.$item->getAlias().'.html';
                }
                if($item->getType()=='url'){
                    $uri= '/'.$item->getUrl();
                }
                if($item->getHome()){
                    $uri = '/';
                }
//                $menu[$parent->$funTitle()]
//                    ->setChildrenAttribute('class', 'sub-menu')
////                    ->setAttribute("class", "dropdown dropdown-large")
//                    ->addChild($item->$funTitle(), array('uri' => $uri))
////                    ->setAttribute("class", "col-sm-6")
                ;
            } else {
                $uri= '/'.$item->getAlias().'.html';
                if($item->getHome()){
                    $uri = '/';
                }
                if($item->getType()=='anchor'){
                    $uri= '/#'.$item->getAlias().'.html';
                }
                if($item->getType()=='url'){
                    $uri= '/'.$item->getUrl();
                }
                $menu->addChild($item->getTitle(), array('uri' => $uri));
                $menu[$item->getTitle()]->setLinkAttribute('class', 'nav-item-link');

            }
            if($request->getPathInfo() == $uri){
                $menu[$item->getTitle()]->setCurrent(true);
            }
        }
        $menu->addChild('Контакты', array('route' => 'site_contacts'));
        $menu['Контакты']->setLinkAttribute('class', 'nav-item-link');
        return $menu;

    }

}