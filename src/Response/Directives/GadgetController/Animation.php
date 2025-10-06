<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

class Animation
{
    /** @param Sequence[] $sequence */
    public function __construct(
        public ?int $repeat = null,
        public array $targetLights = ['1'],
        public array $sequence = []
    ) {
    }

    public static function create(array $sequence, int $repeat = 1, array $targetLights = ['1']): self
    {
        return new self($repeat, $targetLights, $sequence);
    }
}
