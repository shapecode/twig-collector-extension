<?php

namespace Shapecode\Twig\Extensions\Node;

use Twig\Node\Node;
use Twig_Compiler;

/**
 * Class CollectionNode
 *
 * @package Shapecode\Twig\Extensions\Node
 * @author  Nikita Loges
 */
class CollectionNode extends Node
{

    /**
     * @param array $name
     * @param array $line
     * @param null  $tag
     */
    public function __construct($name, $line, $tag = null)
    {
        parent::__construct(['name' => $name], [], $line, $tag);
    }

    /**
     * @inheritdoc
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler->write("echo \Shapecode\Twig\Extensions\Collector\Collector::getInstance()->get('" . $this->getNode('name')->getAttribute('name') . "');");
        $compiler->raw("\n");
    }
}
