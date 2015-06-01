<?php

namespace Shapecode\Twig\Extensions\Node;

use Twig_Node;
use Twig_Compiler;

/**
 * Class CollectionNode
 * @package Shapecode\Twig\Extensions\Node
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 24.04.2015
 */
class CollectionNode extends Twig_Node
{

    /**
     * @param array $name
     * @param array $line
     * @param null $tag
     */
    public function __construct($name, $line, $tag = null)
    {
        parent::__construct(array('name' => $name), array(), $line, $tag);
    }

    /**
     * {@inheritdoc}
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler->write('$globals = $this->env->getGlobals();');
        $compiler->raw("\n");

        $compiler->write('if(isset($globals["_collection_' . $this->getNode('name')->getAttribute('name') . '"])) {');
        $compiler->raw("\n");

        $compiler->write("echo implode(' ', \$globals['_collection_" . $this->getNode('name')->getAttribute('name') . "']);");
        $compiler->raw("\n");

        $compiler->write('}');
        $compiler->raw("\n");

    }
}