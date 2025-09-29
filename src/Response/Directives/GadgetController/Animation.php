<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

class Animation
{
    public ?int $repeat = null;
    public array $targetLights = ['1'];

    /** @var Sequence[] */
    public array $sequence = [];

    public static function create(array $sequence, int $repeat = 1, array $targetLights = ['1']): self
    {
        $animations = new self();

        $animations->repeat = $repeat;
        $animations->targetLights = $targetLights;
        $animations->sequence = $sequence;

        return $animations;
    }
}
