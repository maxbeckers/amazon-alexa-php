<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class StopDirective extends Directive
{
    public const TYPE = 'AudioPlayer.Stop';

    public static function create(): self
    {
        $stopDirective = new self();

        $stopDirective->type = self::TYPE;

        return $stopDirective;
    }
}
