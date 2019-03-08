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
    public $targetLights = ['1'];

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
    public static function create(int $repeat, array $targetLights = ['1'], array $sequence = []): self
    {
        $animations = new self();

        $animations->repeat       = $repeat;
        $animations->targetLights = $targetLights;
        $animations->sequence     = $sequence;

        return $animations;
    }
}
