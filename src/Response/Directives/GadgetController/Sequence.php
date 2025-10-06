<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

class Sequence
{
    public function __construct(
        public ?int $durationMs = null,
        public ?bool $blend = null,
        public ?string $color = null
    ) {
    }

    public static function create(int $durationMs, string $color, bool $blend = false): self
    {
        return new self($durationMs, $blend, $color);
    }
}
