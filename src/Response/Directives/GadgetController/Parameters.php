<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Parameters
{
    const TRIGGER_EVENT_BUTTON_DOWN = 'buttonDown';
    const TRIGGER_EVENT_BUTTON_UP   = 'buttonUp';
    const TRIGGER_EVENT_NONE        = 'none';

    /**
     * @var string|null
     */
    public $triggerEvent;

    /**
     * @var int|null
     */
    public $triggerEventTimeMs;

    /**
     * @var Animations|null
     */
    public $animations;

    /**
     * @param string          $triggerEvent
     * @param int             $triggerEventTimeMs
     * @param Animations|null $animations
     *
     * @return Parameters
     */
    public static function create(string $triggerEvent = self::TRIGGER_EVENT_NONE, int $triggerEventTimeMs = 0, Animations $animations = null): self
    {
        $parameters = new self();

        $parameters->triggerEvent       = $triggerEvent;
        $parameters->triggerEventTimeMs = $triggerEventTimeMs;
        $parameters->animations         = $animations;

        return $parameters;
    }
}
