<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Event
{
    const REPORTS_HISTORY = "history";
    const REPORTS_MATCHES = "matches";
    const REPORTS_NOTHING = "nothing";

    /**
     * @var array
     */
    public $meets = [];

    /**
     * @var array
     */
    public $fails = [];

    /**
     * @var string|null
     */
    public $reports;

    /**
     * @var bool|null
     */
    public $shouldEndInputHandler;

    /**
     * @var int|null
     */
    public $maximumInvocations;

    /**
     * @var int|null
     */
    public $triggerTimeMilliseconds;

    /**
     * @param array       $meets
     * @param bool        $shouldEndInputHandler
     * @param array       $fails
     * @param string|null $reports
     * @param int|null    $maximumInvocations
     * @param int|null    $triggerTimeMilliseconds
     *
     * @return Event
     */
    public static function create(array $meets, bool $shouldEndInputHandler, array $fails = [], string $reports = null, int $maximumInvocations = null, int $triggerTimeMilliseconds = null): self
    {
        $event = new self();

        $event->meets                   = $meets;
        $event->shouldEndInputHandler   = $shouldEndInputHandler;
        $event->fails                   = $fails;
        $event->reports                 = $reports;
        $event->maximumInvocations      = $maximumInvocations;
        $event->triggerTimeMilliseconds = $triggerTimeMilliseconds;

        return $event;
    }
}
