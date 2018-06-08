<?php

namespace Shapecode\Twig\Extensions\TokenParser;

use Shapecode\Twig\Extensions\Node\CollectionNode;
use Twig\Error\SyntaxError;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;
use Twig_Token;

/**
 * Class CollectorParser
 *
 * @package Shapecode\Twig\Extensions\TokenParser
 * @author  Nikita Loges
 */
class CollectionParser extends AbstractTokenParser
{

    /**
     * @inheritdoc
     */
    public function parse(Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $name = $this->parser->getExpressionParser()->parseAssignmentExpression();

        if (count($name) > 1) {
            throw new SyntaxError("When using collection, you cannot have a multi-target.", $stream->getCurrent()->getLine(), $stream->getFilename());
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        return new CollectionNode($name->getNode(0), $token->getLine(), $this->getTag());
    }

    /**
     * @inheritdoc
     */
    public function getTag()
    {
        return 'collection';
    }
}
