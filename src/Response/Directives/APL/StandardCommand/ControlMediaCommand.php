<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ControlMediaCommand as ControlMediaCommandType;

class ControlMediaCommand extends AbstractStandardCommand
{
    public const TYPE = 'ControlMedia';

    /**
     * @param ControlMediaCommandType|null $command The media control command to execute
     * @param string|null $componentId The ID of the component to control
     * @param int|null $value Integer value for commands that require it
     */
    public function __construct(
        public ?ControlMediaCommandType $command = null,
        public ?string $componentId = null,
        public ?int $value = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->command !== null) {
            $data['command'] = $this->command->value;
        }

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->value !== null) {
            $data['value'] = $this->value;
        }

        return $data;
    }
}
