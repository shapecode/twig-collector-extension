<?php

namespace Shapecode\Twig\Extensions\TokenParser;

use Shapecode\Twig\Extensions\Node\CollectionNode;
use Twig_Token;
use Twig_Error_Syntax;

/**
 * Class CollectorParser
 * @package Shapecode\Twig\Extensions\TokenParser
 * @author Nikita Loges
 * @date 24.04.2015
 */
class CollectionParser extends \Twig_TokenParser
{

    /**
     * {@inheritdoc}
     */
    public function parse(Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $name = $this->parser->getExpressionParser()->parseAssignmentExpression();

        if (count($name) > 1) {
            throw new Twig_Error_Syntax("When using collection, you cannot have a multi-target.", $stream->getCurrent()->getLine(), $stream->getFilename());
        }

        $stream->expect(Twig_Token::BLOCK_END_TYPE);


        return new CollectionNode($name->getNode(0), $token->getLine(), $this->getTag());
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return 'collection';
    }
}