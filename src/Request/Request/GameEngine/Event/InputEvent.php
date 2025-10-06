<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event;

class InputEvent
{
    public const ACTION_DOWN = 'down';
    public const ACTION_UP = 'up';

    /**
     * @param string $gadgetId Gadget identifier
     * @param \DateTime $timestamp Event timestamp
     * @param string $action Action type (down/up)
     * @param string $color Color of the input
     * @param string $feature Feature that triggered the event
     */
    public function __construct(
        public string $gadgetId,
        public \DateTime $timestamp,
        public string $action,
        public string $color,
        public string $feature,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            gadgetId: $amazonRequest['gadgetId'],
            timestamp: new \DateTime($amazonRequest['timestamp']),
            action: $amazonRequest['action'],
            color: $amazonRequest['color'],
            feature: $amazonRequest['feature'],
        );
    }
}
