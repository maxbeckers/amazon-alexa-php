<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class Action implements \JsonSerializable
{
    /**
     * @param AbstractStandardCommand|null $command Single command to run
     * @param AbstractStandardCommand[]|null $commands Array of commands to run
     * @param bool $enabled Whether the action is enabled
     * @param string|null $label Label for the action
     * @param string|null $name Name of the action
     */
    public function __construct(
        public ?AbstractStandardCommand $command = null,
        public ?array $commands = null,
        public bool $enabled = true,
        public ?string $label = null,
        public ?string $name = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->command !== null) {
            $data['command'] = $this->command;
        }

        if ($this->commands !== null && !empty($this->commands)) {
            $data['commands'] = $this->commands;
        }

        if (!$this->enabled) {
            $data['enabled'] = $this->enabled;
        }

        if ($this->label !== null) {
            $data['label'] = $this->label;
        }

        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        return $data;
    }
}
