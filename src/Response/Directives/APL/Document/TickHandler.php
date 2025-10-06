<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class TickHandler implements \JsonSerializable
{
    public const DEFAULT_MINIMUM_DELAY = 1000;

    /**
     * @param AbstractStandardCommand[] $commands Commands to run during tick events
     * @param string|null $when APL boolean expression controlling whether the handler is active. Null means always active.
     * @param string $description Optional description of this handler
     * @param int $minimumDelay Minimum delay between tick events in milliseconds
     */
    public function __construct(
        public array $commands = [],
        public ?string $when = null,
        public string $description = '',
        public int $minimumDelay = self::DEFAULT_MINIMUM_DELAY,
    ) {
        // Filter and ensure valid commands
        $this->commands = array_values(array_filter(
            $this->commands,
            static fn ($c) => $c instanceof AbstractStandardCommand
        ));
    }

    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->commands !== []) {
            $data['commands'] = $this->commands;
        }
        if ($this->description !== '') {
            $data['description'] = $this->description;
        }
        if ($this->minimumDelay !== self::DEFAULT_MINIMUM_DELAY) {
            $data['minimumDelay'] = $this->minimumDelay;
        }
        if ($this->when !== null && $this->when !== '') {
            $data['when'] = $this->when;
        }

        return $data;
    }
}
