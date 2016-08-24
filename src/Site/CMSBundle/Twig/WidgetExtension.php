<?php

namespace Site\CMSBundle\Twig;

use Doctrine\ORM\EntityManager;
use RleeCMS\ShopBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RequestStack;

class WidgetExtension extends \Twig_Extension
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /*
     * @var Request
     */
    protected $request;

    /**
     * Constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, \Twig_Environment $twig, ContainerInterface $container, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->container = $container;
        $this->request = $requestStack->getCurrentRequest();

    }

    public function getFunctions()
    {
        return array(
            'cms_widget' => new \Twig_Function_Method($this, 'renderWidget', array(
                'is_safe' => array('html'),
            )),
            'cms_widget_count' => new \Twig_Function_Method($this, 'countWidget', array())

        );
    }

    public function renderWidget($position)
    {
        if ($position == 'login') {
            return $this->login();
        }
        /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router $router */
//        $router = $this->container->get('router');
        $widgets = $this->em->createQueryBuilder()
            ->select('w')
            ->from('AdminCMSBundle:Widget', 'w')
            ->leftJoin('w.menus', 'm')
            ->add('where', 'w.position = :position AND w.status = true')
            ->setParameter('position', $position)
            ->getQuery()->getResult();

        /** @var \RleeCMS\CMSBundle\Entity\Widget $widget */
        foreach ($widgets as $widget) {
            $check = false;
            if ($widget->getMenuCheck() == 'all') {
                $check = true;
            } else if ($widget->getMenuCheck() == 'in_menu') {
                foreach ($widget->getMenus() as $menu) {
                    if ($menu->getId() == $this->request->get('menuId')) {
                        $check = true;
                    }
                }
            } else if ($widget->getMenuCheck() == 'not_menu') {
                $check = true;
                foreach ($widget->getMenus() as $menu) {
                    if ($menu->getId() == $this->request->get('menuId')) {
                        $check = false;
                    }
                }
            } else if ($widget->getMenuCheck() == 'main') {
                if ($this->request->get('menuId')) {
                    $main = $this->em->getRepository('AdminCMSBundle:Menu')->find($this->request->get('menuId'));
                    if ($main and $main->getHome()) {
                        $check = true;
                    }
                }
            } else if ($widget->getMenuCheck() == 'not_main') {
                $check = true;
                if ($this->request->get('menuId')) {
                    $main = $this->em->getRepository('AdminCMSBundle:Menu')->find($this->request->get('menuId'));
                    if ($main and $main->getHome()) {
                        $check = false;
                    }
                }
            }
            if ($check) {
                if ($widget->getType() == 'html') {
                    $arrayWidget = array(
                        'html' => $widget->getHtml(),
                        'title' => $widget->getTitle(),
                        'hideTitle' => $widget->getHideTitle()
                    );
                    return $this->twig->render('CMSBundle:Widgets:html.html.twig', array('widget' => $arrayWidget));
                }
                if ($widget->getType() == 'menu') {
                    $arrayWidget = array(
                        'title' => $widget->getTitle(),
                        'hideTitle' => $widget->getHideTitle(),
                        'params' => $widget->getParams(),
                        'class' => $widget->getClass()
                    );
                    return $this->twig->render('CMSBundle:Widgets:menu.html.twig', array('widget' => $arrayWidget));
                }
                if ($widget->getType() == 'slider') {
                    $params = $widget->getParams();
                    $sliderLimit = 1;
                    if (isset($params['SliderCount']) and $params['SliderCount'] > 1) {
                        $sliderLimit = $params['SliderCount'];
                    }
                    $sliderImages = $this->em
                        ->getRepository('RleeCMSShopBundle:SliderImage')
                        ->createQueryBuilder('si')
                        ->orderBy('si.orderning')
                        ->where('si.status = 1')
                        ->setMaxResults($sliderLimit)
                        ->getQuery()->getResult();
//                    var_dump($sliderImages);die;
                    if (count($sliderImages) > 0) {
                        $arrayWidget = array(
                            'title' => $widget->getTitle(),
                            'hideTitle' => $widget->getHideTitle(),
                            'params' => $widget->getParams(),
                            'class' => $widget->getClass(),
                            'sliderImages' => $sliderImages
                        );
                        return $this->twig->render('CMSBundle:Widgets:slider.html.twig', array('widget' => $arrayWidget));
                    } else {
                        return null;
                    }

                }
                if ($widget->getType() == 'category') {
                    $params = $widget->getParams();
                    if (isset($params['Category'])) {
                        $category =  $this->em->getRepository('RleeCMSShopBundle:Category')->find($params['Category']);
                    }
                    $arrayWidget = array(
                        'title' => $widget->getTitle(),
                        'hideTitle' => $widget->getHideTitle(),
                        'params' => $widget->getParams(),
                        'class' => $widget->getClass(),
                        'num' => $widget->getOrderning(),
                        'titleHtml' => $widget->getTitleHtml(),
                        'category' => $category,
                    );
                    return $this->twig->render('CMSBundle:Widgets:category.html.twig', array('widget' => $arrayWidget));
                }
                if ($widget->getType() == 'product') {
                    $params = $widget->getParams();
                    $product = new Product();
                    if (isset($params['Product'])) {
                        $product =  $this->em->getRepository('RleeCMSShopBundle:Product')->find($params['Product']);
                    }
                    $arrayWidget = array(
                        'iFrame'   => $widget->getYoutubeSrc(),
                        'title' => $widget->getTitle(),
                        'hideTitle' => $widget->getHideTitle(),
                        'params' => $widget->getParams(),
                        'class' => $widget->getClass(),
                        'num' => $widget->getOrderning(),
                        'titleHtml' => $widget->getTitleHtml(),
                        'product' => $product
                    );
                    return $this->twig->render('CMSBundle:Widgets:product.html.twig', array('widget' => $arrayWidget));
                }
            }
        }
    }

    public function countWidget($position)
    {
        /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router $router */
        $router = $this->container->get('router');
        $widgets = $this->em->createQueryBuilder()
            ->select('w')
            ->from('AdminCMSBundle:Widget', 'w')
            ->leftJoin('w.menus', 'm')
            ->add('where', 'w.position = :position AND w.status = true')
            ->setParameter('position', $position)
            ->getQuery()->getResult();
        foreach ($widgets as $widget) {
            $check = false;
            if ($widget->getMenuCheck() == 'all') {
                $check = true;
            } else if ($widget->getMenuCheck() == 'in_menu') {
                foreach ($widget->getMenus() as $menu) {
                    if ($menu->getId() == $this->request->get('menuId') || $widget->getId()== $this->request->get('menuId')) {
                        $check = true;
                    }
                }
            } else if ($widget->getMenuCheck() == 'not_menu') {
                $check = true;
                foreach ($widget->getMenus() as $menu) {
                    if ($menu->getId() == $this->request->get('menuId')) {
                        $check = false;
                    }
                }
            } else if ($widget->getMenuCheck() == 'main') {
                if ($this->request->get('menuId')) {
                    $main = $this->em->getRepository('AdminCMSBundle:Menu')->find($this->request->get('menuId'));
                    if ($main and $main->getHome()) {
                        $check = true;
                    }
                }
            } else if ($widget->getMenuCheck() == 'not_main') {
                $check = true;
                if ($this->request->get('menuId')) {
                    $main = $this->em->getRepository('AdminCMSBundle:Menu')->find($this->request->get('menuId'));
                    if ($main and $main->getHome()) {
                        $check = false;
                    }
                }
            }
            if ($check) {
                return count($widgets);
            } else {
                return 0;
            }
        }
//        var_dump($widgets[0][1]);
//        die;
    }

    /**
     * Функция вывода виджета вдля авторизации
     */
    public function login()
    {
        $session = $this->request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($this->request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->twig->render('CMSBundle:Widgets:login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));

    }

    public function getName()
    {
        return 'cms_widget_extension';
    }
}