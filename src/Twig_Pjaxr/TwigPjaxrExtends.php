<?php

namespace Iekadou\TwigPjaxr;

use Iekadou\Pjaxr\Pjaxr as Pjaxr;
/*
 *
 * (c) 2015 Jonas Braun
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Extends a template by one or another, depending on whether the namespace matches
 *
 * <pre>
 *  {% pjaxr_extends "__base.html" %}
 *  or
 *  {% pjaxr_extends "__base.html" "__pjaxr.html" %}
 *  or
 *  {% pjaxr_extends "__base.html" "__pjaxr.html" "Pjaxr.Namespace" %}
 * </pre>
 */
class Twig_Pjaxr_TokenParser_PjaxrExtends extends \Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token A Twig_Token instance
     *
     * @return Twig_NodeInterface A Twig_NodeInterface instance
     */
    public function parse(\Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $extension_namespace = null;
        $pjaxr_template = null;
        if (!$this->parser->isMainScope()) {
            throw new \Twig_Error_Syntax('Cannot extend from a block', $token->getLine(), $this->parser->getFilename());
        }

        if (null !== $this->parser->getParent()) {
            throw new \Twig_Error_Syntax('Multiple extends tags are forbidden', $token->getLine(), $this->parser->getFilename());
        }

        $default_template = $this->parser->getExpressionParser()->parseExpression();
        if (!$stream->test(\Twig_Token::BLOCK_END_TYPE)) {
            $arg2 = $this->parser->getExpressionParser()->parseExpression();
            if (!$stream->test(\Twig_Token::BLOCK_END_TYPE)) {
                $arg3 = $this->parser->getExpressionParser()->parseExpression();
            }
        }
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        if (isset($arg2)) {
            if (isset($arg3)) {
                $pjaxr_template = $arg2;
                $extension_namespace = $arg3;
            } else {
                $pjaxr_template = new \Twig_Node_Expression_Constant("__pjaxr.html", $token->getLine());
                $extension_namespace = $arg2;
            }
        }
        $arguments = new \Twig_Node_Expression_Array(array(), $token->getLine());
        $arguments->addElement($default_template);
        $arguments->addElement($pjaxr_template);
        $arguments->addElement($extension_namespace);
        $this->parser->setParent(new \Twig_Node_Expression_Function('pjaxr_matching', $arguments, $token->getLine()));
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'pjaxr_extends';
    }
}
