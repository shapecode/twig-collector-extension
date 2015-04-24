<?php

namespace Shapecode\Twig\Extensions\TokenParser;

use Shapecode\Twig\Extensions\Node\CollectorNode;
use Twig_Token;
use Twig_Error_Syntax;

/**
 * Class CollectorParser
 * @package Shapecode\Twig\Extensions\TokenParser
 * @author Nikita Loges
 * @date 24.04.2015
 */
class CollectorParser extends \Twig_TokenParser
{

    /**
     * {@inheritdoc}
     */
    public function parse(Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $names = $this->parser->getExpressionParser()->parseAssignmentExpression();

        if (count($names) > 1) {
            throw new Twig_Error_Syntax("When using collector, you cannot have a multi-target.", $stream->getCurrent()->getLine(), $stream->getFilename());
        }

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        $values = $this->parser->subparse(array($this, 'decideBlockEnd'), true);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new CollectorNode($names[0], $values[0], $token->getLine(), $this->getTag());
    }

    /**
     * @param Twig_Token $token
     * @return bool
     */
    public function decideBlockEnd(Twig_Token $token)
    {
        return $token->test('endcollector');
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return 'collector';
    }
}