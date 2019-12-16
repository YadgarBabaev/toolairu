<?php

namespace Site\CMSBundle\Twig;


class TextExtension extends \Twig_Extension
{
    public function getFilters() {
        return array(
        	'pluralize' => new \Twig_Filter_Method($this, 'pluralize'),
        );
    }

    public function pluralize($amount, $titles)
    {
        $cases = array(2, 0, 1, 1, 1, 2);
        $title = $titles[($amount % 100 > 4 && $amount % 100 < 20)? 2 : $cases[min($amount % 10, 5)]];
        return $title;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'text';
    }
}