<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class HintDirective extends Directive
{
    const TYPE = 'Hint';

    /**
     * @var Text|null
     */
    public $text;


    public static function create(Text $text): self
    {
        $hint = new self();

        $hint->type = self::TYPE;
        $hint->text = $text;

        return $hint;
    }
}
