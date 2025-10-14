<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Event
{
    public const REPORTS_HISTORY = 'history';
    public const REPORTS_MATCHES = 'matches';
    public const REPORTS_NOTHING = 'nothing';

    public function __construct(
        public array $meets = [],
        public ?array $fails = null,
        public ?string $reports = null,
        public ?bool $shouldEndInputHandler = null,
        public ?int $maximumInvocations = null,
        public ?int $triggerTimeMilliseconds = null
    ) {
    }

    public static function create(array $meets, bool $shouldEndInputHandler, ?array $fails = null, ?string $reports = null, ?int $maximumInvocations = null, ?int $triggerTimeMilliseconds = null): self
    {
        return new self($meets, $fails, $reports, $shouldEndInputHandler, $maximumInvocations, $triggerTimeMilliseconds);
    }
}
