<?php

namespace Shapecode\Twig\Extensions\Node;

use Twig\Node\Node;
use Twig_Compiler;

/**
 * Class CollectorNode
 *
 * @package Shapecode\Twig\Extensions\Node
 * @author  Nikita Loges
 */
class CollectorNode extends Node
{

    /**
     * @inheritdoc
     */
    public function __construct($names, $values, $line, $tag = null)
    {
        parent::__construct(['name' => $names, 'values' => $values], [], $line, $tag);
    }

    /**
     * @inheritdoc
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler->write("ob_start();\n");

        $compiler->subcompile($this->getNode('values'));

        $compiler->raw("\$collector_value = (('' === \$tmp = ob_get_clean()) ? '' : new Twig_Markup(\$tmp, \$this->env->getCharset()));");
        $compiler->raw("\Shapecode\Twig\Extensions\Collector\Collector::getInstance()->set('" . $this->getNode('name')->getAttribute('name') . "', \$collector_value);");

        $compiler->raw("\n");

    }
}
