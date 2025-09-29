<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

class Sequence
{
    public ?int $durationMs = null;
    public ?bool $blend = null;
    public ?string $color = null;

    public static function create(int $durationMs, string $color, bool $blend = false): self
    {
        $sequence = new self();

        $sequence->durationMs = $durationMs;
        $sequence->color = $color;
        $sequence->blend = $blend;

        return $sequence;
    }
}
