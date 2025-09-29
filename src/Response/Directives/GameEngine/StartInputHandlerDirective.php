<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class StartInputHandlerDirective extends Directive
{
    public const TYPE = 'GameEngine.StartInputHandler';

    public ?int $timeout = null;
    public array $proxies = [];

    /** @var Recognizer[] */
    public array $recognizers = [];

    /** @var Event[] */
    public array $events = [];

    public static function create(int $timeout, array $recognizers, array $events, array $proxies = []): self
    {
        $setLight = new self();

        $setLight->type = self::TYPE;
        $setLight->timeout = $timeout;
        $setLight->recognizers = $recognizers;
        $setLight->events = $events;
        $setLight->proxies = $proxies;

        return $setLight;
    }
}
