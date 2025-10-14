<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class StopDirective extends Directive
{
    public const TYPE = 'AudioPlayer.Stop';

    public function __construct()
    {
        parent::__construct(self::TYPE);
    }

    public static function create(): self
    {
        return new self();
    }
}
