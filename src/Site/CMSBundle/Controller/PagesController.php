<?php

namespace Site\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 */
class PagesController extends Controller
{
    /**
     * Route("/{alias}.html", name="router")
     * Method("GET")
     * @Template()
     *
     */
    public function routerAction(Request $request, $alias)
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
            $breadcrumbs->addItem('Главная', $this->generateUrl('site_index'));
            $breadcrumbs->addItem($menu->getTitle());
        }
        if ($menu->getType() == 'content' || $menu->getType() == 'blog') {
            $date = $menu->getPage()->getPublished();
            if (!$date) {
                $date = $menu->getCreated();
            }
            $date = strtotime($date->format('Y-m-d H:i:s'));
            $dateNow = strtotime(date('Y-m-d H:i:s'));
            if (($dateNow - $date) >= 0) {
                $published = true;
            } else {
                $published = false;
            }

        }
        $arrayContent = array(
            'title' => $menu->getPage()->getTitle(),
            'params' => $menu->getPage()->getParams(),
            'fullName' => $menu->getPage()->getFullName(),
            'content' => $menu->getPage()->getContent(),
            'description' => $menu->getPage()->getDescription(),
            'keywords' => $menu->getPage()->getKeywords(),
            'published' => $menu->getPage()->getPublished(),
//            'alias' => $menu->getPage()->getAlias(),
            'alias' => $menu->getAlias(),
        );

        if ($menu->getType() == 'blog') {
            $content = $menu->getPage();
            $news = $content->getChildren();
            $img = array();
            $arrayNews = array();
            foreach ($news as $new) {
                $arrNews = array(
                    'id' => $new->getId(),
                    'alias' => $new->getAlias(),
                    'status' => $new->getStatus(),
                    'title' => $new->getTitle(),
                    'fullName' => $new->getFullName(),
                    'content' => $new->getContent(),
                    'published' => $new->getPublished()
                );
                preg_match('/<img[^>]+>/i', $new->getContent(), $res);
                if (!empty($res)) {
                    $img[$new->getId()] = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $res[0]);
                }
                $arrayNews[$new->getId()] = $arrNews;
            }
            return $this->render('CMSBundle:Pages:blog.html.twig', array(
                'content' => $arrayContent,
                'news' => $arrayNews,
                'img' => $img,
                '_route' => $request->attributes->get('_route'),
                'published' => $published,
            ));
        }
        return array(
            'content' => $arrayContent,
            'published' => $published,
        );
    }

    /**
     * Вывод материала из типа БЛОГ
     * Route("/{alias}/{blogAlias}.html", name="routerBlog")
     * @Method("GET")
     * @Template()
     */
    public function blogShowAction(Request $request, $alias, $blogAlias)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $session->set('alias', $alias);

        $translator = $this->get('translator');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdminCMSBundle:Menu');
        /** @var  $menu \RleeCMS\CMSBundle\Entity\Menu */
        $parent = $repository->findOneBy(
            array(
                'alias' => $alias,
                'status' => 1
            )
        );
        if (!$parent) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        $page = $parent->getPage();
        if (!$page) {
            throw $this->createNotFoundException($translator->trans('page_not_found'));
        }
        if ($parent->getType() == 'blog') {
//            die;
            $content = $em->getRepository('AdminCMSBundle:Pages')->findOneBy(array('alias' => $blogAlias, 'status' => 1));
            if (!$content) {
                throw $this->createNotFoundException();
            }
            if ($content->getParent()->getId() == $page->getId()) {
                if ($content->getAlias() != 'root') {

                    $breadcrumbs = $this->get("white_october_breadcrumbs");
                    // Simple example
                    $breadcrumbs->addItem('Главная', '/');
//                    if ($content->getParent()) {
//                        $parentMenu = $em->getRepository('AdminCMSBundle:Menu')->findOneBy(array('page' => $content->getParent()->getId(), 'status' => 1));
//                        if ($parentMenu) {
//                            $breadcrumbs->addItem($content->getParent()->getFullName(), $parentMenu->getAlias().'.html');
//                        }
//                    }
                    $breadcrumbs->addItem($content->getFullName());
                }

                $date = $content->getPublished();
                if (!$date) {
                    $date = $content->getCreated();
                }
                $date = strtotime($date->format('Y-m-d H:i:s'));
                $dateNow = strtotime(date('Y-m-d H:i:s'));
                if (($dateNow - $date) >= 0) {
                    $published = true;
                } else {
                    $published = false;
                }
                $arrayContent = array(
                    'title' => $content->getTitle(),
                    'params' => $content->getParams(),
                    'fullName' => $content->getFullName(),
                    'content' => $content->getContent(),
                    'description' => $content->getDescription(),
                    'keywords' => $content->getKeywords(),
                    'published' => $content->getPublished(),
                    'images'    => $content->getImages()
                );
                return $this->render('CMSBundle:Pages:router.html.twig',
                    array(
                        'content' => $arrayContent,
                        'published' => $published,
                    )
                );
            }
        }
        throw $this->createNotFoundException($translator->trans('page_not_found'));

    }


}