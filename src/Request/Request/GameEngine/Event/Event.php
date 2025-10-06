<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event;

class Event
{
    /**
     * @param string $name Event name
     * @param InputEvent[] $inputEvents Array of input events
     */
    public function __construct(
        public string $name,
        public array $inputEvents = [],
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $inputEvents = [];
        foreach ($amazonRequest['inputEvents'] as $_event) {
            $inputEvents[] = InputEvent::fromAmazonRequest($_event);
        }

        return new self(
            name: $amazonRequest['name'],
            inputEvents: $inputEvents,
        );
    }
}
