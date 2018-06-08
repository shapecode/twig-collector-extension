<?php

namespace Shapecode\Twig\Extensions\Extension;

use Shapecode\Twig\Extensions\TokenParser\CollectionParser;
use Shapecode\Twig\Extensions\TokenParser\CollectorParser;
use Twig\Extension\AbstractExtension;

/**
 * Class CollectorExtension
 *
 * @package Shapecode\Twig\Extensions\Extension
 * @author  Nikita Loges
 */
class CollectorExtension extends AbstractExtension
{

    /**
     * @inheritdoc
     */
    public function getTokenParsers()
    {
        return [
            new CollectorParser(),
            new CollectionParser()
        ];
    }
}
