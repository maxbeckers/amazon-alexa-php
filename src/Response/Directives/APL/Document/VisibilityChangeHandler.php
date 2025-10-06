<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class VisibilityChangeHandler implements \JsonSerializable
{
    /**
     * @param AbstractStandardCommand[] $commands List of commands to run (evaluated in order).
     * @param string|null $when APL boolean expression controlling whether this handler is considered. If null, treated as 'true'.
     * @param string|null $description Optional description of this handler.
     */
    public function __construct(
        public array $commands = [],
        public ?string $when = null,
        public ?string $description = null,
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
        if ($this->description !== null && $this->description !== '') {
            $data['description'] = $this->description;
        }
        if ($this->when !== null && $this->when !== '') {
            $data['when'] = $this->when;
        }

        return $data;
    }
}
