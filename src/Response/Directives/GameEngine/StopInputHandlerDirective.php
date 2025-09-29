<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class StopInputHandlerDirective extends Directive
{
    public const TYPE = 'GameEngine.StopInputHandler';

    public ?string $originatingRequestId = null;

    public static function create(string $originatingRequestId): self
    {
        $setLight = new self();

        $setLight->type = self::TYPE;
        $setLight->originatingRequestId = $originatingRequestId;

        return $setLight;
    }
}
