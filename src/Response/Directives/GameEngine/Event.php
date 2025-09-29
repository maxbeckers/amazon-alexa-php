<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

class Event
{
    public const REPORTS_HISTORY = 'history';
    public const REPORTS_MATCHES = 'matches';
    public const REPORTS_NOTHING = 'nothing';

    public array $meets = [];
    public ?array $fails = null;
    public ?string $reports = null;
    public ?bool $shouldEndInputHandler = null;
    public ?int $maximumInvocations = null;
    public ?int $triggerTimeMilliseconds = null;

    public static function create(array $meets, bool $shouldEndInputHandler, ?array $fails = null, ?string $reports = null, ?int $maximumInvocations = null, ?int $triggerTimeMilliseconds = null): self
    {
        $event = new self();

        $event->meets = $meets;
        $event->shouldEndInputHandler = $shouldEndInputHandler;
        $event->fails = $fails;
        $event->reports = $reports;
        $event->maximumInvocations = $maximumInvocations;
        $event->triggerTimeMilliseconds = $triggerTimeMilliseconds;

        return $event;
    }
}
