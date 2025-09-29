<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event;

class InputEvent
{
    public const ACTION_DOWN = 'down';
    public const ACTION_UP = 'up';

    public string $gadgetId;
    public \DateTime $timestamp;
    public string $action;
    public string $color;
    public string $feature;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $event = new self();

        $event->gadgetId = $amazonRequest['gadgetId'];
        $event->timestamp = new \DateTime($amazonRequest['timestamp']);
        $event->action = $amazonRequest['action'];
        $event->color = $amazonRequest['color'];
        $event->feature = $amazonRequest['feature'];

        return $event;
    }
}
