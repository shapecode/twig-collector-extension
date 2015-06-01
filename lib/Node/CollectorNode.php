<?php

namespace Shapecode\Twig\Extensions\Node;

use Twig_Node;
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
    public function __construct($names, $values, $line, $tag = null)
    {
        parent::__construct(array('name' => $names, 'values' => $values), array(), $line, $tag);
    }

    /**
     * {@inheritdoc}
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler->write('$globals = $this->env->getGlobals();');
        $compiler->raw("\n");

        $compiler->write('if(!isset($globals["_collection_' . $this->getNode('name')->getAttribute('name') . '"])) { $globals["_collection_' . $this->getNode('name')->getAttribute('name') . '"] = array(); }');
        $compiler->raw("\n");

        $compiler->write('$collection = $globals["_collection_' . $this->getNode('name')->getAttribute('name') . '"];');
        $compiler->raw("\n");

        $compiler->write("ob_start();\n");
        $compiler->subcompile($this->getNode('values'));
        $compiler->raw("\$collection[] = (('' === \$tmp = ob_get_clean()) ? '' : new Twig_Markup(\$tmp, \$this->env->getCharset()));");

        $compiler->raw("\n");

        $compiler->raw("\$this->env->addGlobal('_collection_" . $this->getNode('name')->getAttribute('name') . "', \$collection);");

    }
}