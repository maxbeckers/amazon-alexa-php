<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

class SelectCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'Select';

    /**
     * @param string|null $componentId ID of the component to select
     * @param AbstractStandardCommand[]|null $commands Commands to run when condition is true
     * @param array|null $data Array of data to iterate over
     * @param AbstractStandardCommand[]|null $otherwise Commands to run when condition is false
     */
    public function __construct(
        public ?string $componentId = null,
        public ?array $commands = null,
        public ?array $data = null,
        public ?array $otherwise = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->commands !== null && !empty($this->commands)) {
            $data['commands'] = $this->commands;
        }

        if ($this->data !== null && !empty($this->data)) {
            $data['data'] = $this->data;
        }

        if ($this->otherwise !== null && !empty($this->otherwise)) {
            $data['otherwise'] = $this->otherwise;
        }

        return $data;
    }
}
