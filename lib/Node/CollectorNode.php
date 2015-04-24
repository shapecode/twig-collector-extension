<?php

namespace Shapecode\Twig\Extensions\Node;

use Twig_Node;
use Twig_Node_Expression;
use Twig_Compiler;

/**
 * Class CollectorNode
 * @package Shapecode\Twig\Extensions\Node
 * @author Nikita Loges
 * @date 24.04.2015
 */
class CollectorNode extends Twig_Node
{

    /**
     * {@inheritdoc}
     */
    public function __construct($name, Twig_Node_Expression $value, $line, $tag = null)
    {
        parent::__construct(array('value' => $value), array('name' => $name, 'safe' => true), $line, $tag);
    }

    /**
     * {@inheritdoc}
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler->write("ob_start();\n");

        $compiler->subcompile($this->getNode('value'));

        $compiler->subcompile($this->getNode('name'), false);
        $compiler->write('$collector[\'' . $this->getAttribute('name') . '\'][]');
        $compiler->raw(" = ('' === \$tmp = ob_get_clean()) ? '' : new Twig_Markup(\$tmp, \$this->env->getCharset())");

        $compiler->raw(";\n");
    }
}