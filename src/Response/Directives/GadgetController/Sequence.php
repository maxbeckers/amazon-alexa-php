<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Sequence
{
    /**
     * @var int|null
     */
    public $durationMs;

    /**
     * @var bool|null
     */
    public $blend;

    /**
     * @var string|null
     */
    public $color;

    /**
     * @param int    $durationMs
     * @param string $color
     * @param bool   $blend
     *
     * @return Parameters
     */
    public static function create(int $durationMs, string $color, bool $blend = false): self
    {
        $animations = new self();

        $animations->durationMs       = $durationMs;
        $animations->color            = $color;
        $animations->blend            = $blend;

        return $animations;
    }
}
