<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Animations
{
    /**
     * @var int|null
     */
    public $repeat;

    /**
     * @var array
     */
    public $targetLights = [];

    /**
     * @var Sequence[]
     */
    public $sequence = [];

    /**
     * @param int        $repeat
     * @param array      $targetLights
     * @param Sequence[] $sequence
     *
     * @return Animations
     */
    public static function create(int $repeat, array $targetLights = [], array $sequence = []): self
    {
        $animations = new self();

        $animations->repeat       = $repeat;
        $animations->targetLights = $targetLights;
        $animations->sequence     = $sequence;

        return $animations;
    }
}
