<?php
namespace AppBundle\Twig;


class MonExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('html', [$this, 'html'], ['is_safe' => ['html']]),
        ];
    }

    public function html($html)
    {
        return $html;
    }

    public function getName()
    {
        return 'mon_extension';
    }
}