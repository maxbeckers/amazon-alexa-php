<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class HintDirective extends Directive
{
    public const TYPE = 'Hint';

    public ?Text $hint = null;

    public static function create(Text $text): self
    {
        $hint = new self();

        $hint->type = self::TYPE;
        $hint->hint = $text;

        return $hint;
    }
}
