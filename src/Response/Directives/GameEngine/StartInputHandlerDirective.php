<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class StartInputHandlerDirective extends Directive
{
    public const TYPE = 'GameEngine.StartInputHandler';

    /**
     * @param Recognizer[] $recognizers
     * @param Event[] $events
     */
    public function __construct(
        public ?int $timeout = null,
        public array $proxies = [],
        public array $recognizers = [],
        public array $events = []
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(int $timeout, array $recognizers, array $events, array $proxies = []): self
    {
        return new self($timeout, $proxies, $recognizers, $events);
    }
}
