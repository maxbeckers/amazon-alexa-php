<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class StartInputHandlerDirective extends Directive
{
    const TYPE = 'GameEngine.StartInputHandler';

    /**
     * @var int|null
     */
    public $timeout;

    /**
     * @var array
     */
    public $proxies = [];

    /**
     * @var Recognizer[]
     */
    public $recognizers = [];

    /**
     * @var Event[]
     */
    public $events = [];

    /**
     * @param int          $timeout
     * @param Recognizer[] $recognizers
     * @param Event[]      $events
     * @param array        $proxies
     *
     * @return StartInputHandlerDirective
     */
    public static function create(int $timeout, array $recognizers, array $events, array $proxies = []): self
    {
        $setLight = new self();

        $setLight->type        = self::TYPE;
        $setLight->timeout     = $timeout;
        $setLight->recognizers = $recognizers;
        $setLight->events      = $events;
        $setLight->proxies     = $proxies;

        return $setLight;
    }
}
