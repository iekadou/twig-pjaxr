<?php

namespace Iekadou\TwigPjaxr;

use Iekadou\Pjaxr\Pjaxr as Pjaxr;

/*
 *
 * (c) 2015 Jonas Braun
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Twig_Pjaxr_Extension extends \Twig_Extension
{
    public function getTokenParsers()
    {
        return array(
            new Twig_Pjaxr_TokenParser_PjaxrExtends(),
        );
    }

    public function getName()
    {
        return 'pjaxr_twig_extension';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('pjaxr_matching', array($this, 'pjaxr_matching'))
        );
    }

    public function pjaxr_matching($default_key, $default_template, $pjaxr_key, $pjaxr_template, $namespace_key, $extension_namespace){
        if (isset($pjaxr_template) && Pjaxr::matches($extension_namespace)) {
            return $pjaxr_template;
        } else {
            return $default_template;
        }
    }


    public function getGlobals()
    {
        return array(
            'pjaxr_namespace' => Pjaxr::get_current_namespace(),
        );
    }
}
