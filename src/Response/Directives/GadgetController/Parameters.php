<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

class Parameters
{
    public const TRIGGER_EVENT_BUTTON_DOWN = 'buttonDown';
    public const TRIGGER_EVENT_BUTTON_UP = 'buttonUp';
    public const TRIGGER_EVENT_NONE = 'none';

    public ?string $triggerEvent = null;
    public ?int $triggerEventTimeMs = null;

    /** @var Animation[] */
    public array $animations = [];

    public static function create(array $animations, string $triggerEvent = self::TRIGGER_EVENT_NONE, int $triggerEventTimeMs = 0): self
    {
        $parameters = new self();

        $parameters->triggerEvent = $triggerEvent;
        $parameters->triggerEventTimeMs = $triggerEventTimeMs;
        $parameters->animations = $animations;

        return $parameters;
    }
}
