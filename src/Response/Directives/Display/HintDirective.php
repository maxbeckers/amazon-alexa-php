<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class HintDirective extends Directive
{
    public const TYPE = 'Hint';

    public function __construct(
        public ?Text $hint = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(Text $text): self
    {
        return new self($text);
    }
}
