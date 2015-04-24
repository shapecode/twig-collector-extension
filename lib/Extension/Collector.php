<?php

namespace Shapecode\Twig\Extensions\Extension;

use Shapecode\Twig\Extensions\TokenParser\CollectorParser;

/**
 * Class Collector
 * @package Shapecode\Twig\Extensions\Extension
 * @author Nikita Loges
 * @date 24.04.2015
 */
class Collector extends \Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(new CollectorParser());
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'collector';
    }
}