<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Command implements \JsonSerializable
{
    /**
     * @param Parameter[]|null $parameters Array of parameter definitions
     * @param AbstractStandardCommand|null $command Single command to run
     * @param AbstractStandardCommand[]|null $commands Array of commands to run
     * @param string|null $description Description of this command
     */
    public function __construct(
        public ?array $parameters = null,
        public ?AbstractStandardCommand $command = null,
        public ?array $commands = null,
        public ?string $description = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->parameters !== null) {
            $data['parameters'] = $this->parameters;
        }

        if ($this->command !== null) {
            $data['command'] = $this->command;
        }

        if ($this->commands !== null) {
            $data['commands'] = $this->commands;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        return $data;
    }
}
