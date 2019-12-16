<?php

namespace Site\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 */
class MenuController extends Controller
{
    /**
     * @Route("/cms/menu/list", name="cms_get_menu_list")
     */
    public function menuListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('AdminCMSBundle:Menu')->findBy(array(
            'status' => 1
        ));

        $response = array();
        foreach ($menus as $key => $menu) {
            $alias = '/';
            if (!$menu->getHome()) {
                $alias .= $menu->getAlias();
                $alias .= '.html';
            }
            array_push($response,array($alias, $menu->getTitle()));
        }

        return new JsonResponse($response);
    }

}