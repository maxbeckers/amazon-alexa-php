<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ParallelCommand extends AbstractStandardCommand
{
    public const TYPE = 'Parallel';

    /**
     * @param array|null $data Array of data to iterate over
     * @param AbstractStandardCommand[]|null $commands Commands to run in parallel
     */
    public function __construct(
        public ?array $data = null,
        public ?array $commands = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->data !== null && !empty($this->data)) {
            $data['data'] = $this->data;
        }

        if ($this->commands !== null && !empty($this->commands)) {
            $data['commands'] = $this->commands;
        }

        return $data;
    }
}
