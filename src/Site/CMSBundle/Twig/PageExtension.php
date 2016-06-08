<?php

namespace Site\CMSBundle\Twig;
use Symfony\Component\HttpFoundation\RequestStack;

class PageExtension extends \Twig_Extension
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Constructor
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('beforeLastChar', array($this, 'beforeLastCharFilter')),
        );
    }

    public function getFunctions() {
        return array(
            'active' => new \Twig_Function_Method($this, 'isActive'),
        );
    }

    public function beforeLastCharFilter($haystack,$needle=null, $inclusive = true)
    {
        if (!empty($haystack)) {
            $haystack = substr($haystack, 0, strrpos($haystack, $needle));
            if ($inclusive)
                $haystack=$haystack.$needle;
        }
        return $haystack;
    }

    public function isActive($routes)
    {
        if (!is_array($routes)) {
            $routes = array($routes);
        }
        $route = $this->request->get('_route');
        if (in_array($route, $routes)) {
            return 'active';
        }
        else {
            return null;
        }
    }

    public function getName()
    {
        return 'cms_extension';
    }
}