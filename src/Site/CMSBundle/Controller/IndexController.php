<?php

namespace Site\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Index controller.
 *
 *
 */
class IndexController extends Controller
{
    /**
     * @Route("/", name="site_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $translator = $this->get('translator');

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($translator->trans('home_page'), $this->generateUrl('site_index'));

        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('AdminCMSBundle:Menu')->findOneBy(array('home' => true, 'status' => 1));
        if ($menu) {
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
                'alias' => $menu->getPage()->getAlias(),
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
                        $img[$new->getId()] = $res[0];
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
            return $this->render('CMSBundle:Pages:router.html.twig', array(
                'content' => $arrayContent,
                'published' => $published,
            ));
        } else {
//            $fun = 'getName';
//            if ($locale != 'ru') {
//                $fun = 'get' . (ucfirst($locale)) . 'Name';
//            }
//            $entities = $em->createQueryBuilder()
//                ->select('t')
//                ->from('AdminReferenceBundle:TypeWaterBody', 't')
//                ->where('t.status = 1')
//                ->getQuery()->getResult();
//            $arrEntities = array();
//            foreach($entities as $entity) {
//                $arrEntities[$entity->getId()] = array(
//                    'name' => $entity->$fun(),
//                    'code' => $entity->getCode(),
//                );
//            }

            return array();
        }
    }
}
