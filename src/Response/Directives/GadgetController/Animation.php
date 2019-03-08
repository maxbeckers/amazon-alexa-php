<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Animation
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
     * @return Animation
     */
    public static function create(array $sequence, int $repeat=1, array $targetLights = ['1']): self
    {
        $animations = new self();

        $animations->repeat       = $repeat;
        $animations->targetLights = $targetLights;
        $animations->sequence     = $sequence;

        return $animations;
    }
}
