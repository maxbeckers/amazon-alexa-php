<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class KeyHandler implements \JsonSerializable
{
    /**
     * @param AbstractStandardCommand[] $commands Commands to run when handler applies
     * @param bool $propagate Whether to propagate the event after handling
     * @param string|null $when APL boolean expression controlling whether this handler is considered
     */
    public function __construct(
        public array $commands = [],
        public bool $propagate = false,
        public ?string $when = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'commands' => $this->commands,
            'propagate' => $this->propagate,
            'when' => $this->when,
        ], fn ($value) => $value !== null);
    }
}
