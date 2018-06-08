<?php

namespace Shapecode\Twig\Extensions\TokenParser;

use Shapecode\Twig\Extensions\Node\CollectorNode;
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
class CollectorParser extends AbstractTokenParser
{

    /**
     * @inheritdoc
     */
    public function parse(Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $name = $this->parser->getExpressionParser()->parseAssignmentExpression();

        if (count($name) > 1) {
            throw new SyntaxError("When using collector, you cannot have a multi-target.", $stream->getCurrent()->getLine(), $stream->getFilename());
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        $value = $this->parser->subparse([$this, 'decideBlockEnd'], true);
        $stream->expect(Token::BLOCK_END_TYPE);

        return new CollectorNode($name->getNode(0), $value, $token->getLine(), $this->getTag());
    }

    /**
     * @param Twig_Token $token
     *
     * @return bool
     */
    public function decideBlockEnd(Twig_Token $token)
    {
        return $token->test('endcollector');
    }

    /**
     * @inheritdoc
     */
    public function getTag()
    {
        return 'collector';
    }
}
