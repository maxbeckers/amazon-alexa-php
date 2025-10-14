<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class SequentialCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'Sequential';

    /**
     * @param AbstractStandardCommand[]|null $catch Commands to run if an error occurs
     * @param AbstractStandardCommand[]|null $commands Commands to run sequentially
     * @param array|null $data Array of data to iterate over
     * @param int|null $repeatCount Number of times to repeat the sequence
     * @param AbstractStandardCommand[]|null $finally Commands to run after completion
     */
    public function __construct(
        public ?array $catch = null,
        public ?array $commands = null,
        public ?array $data = null,
        public ?int $repeatCount = null,
        public ?array $finally = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->catch !== null && !empty($this->catch)) {
            $data['catch'] = $this->catch;
        }

        if ($this->commands !== null && !empty($this->commands)) {
            $data['commands'] = $this->commands;
        }

        if ($this->data !== null && !empty($this->data)) {
            $data['data'] = $this->data;
        }

        if ($this->repeatCount !== null) {
            $data['repeatCount'] = $this->repeatCount;
        }

        if ($this->finally !== null && !empty($this->finally)) {
            $data['finally'] = $this->finally;
        }

        return $data;
    }
}
