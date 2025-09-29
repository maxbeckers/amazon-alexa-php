<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event;

class Event
{
    public string $name;

    /** @var InputEvent[] */
    public array $inputEvents = [];

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $event = new self();

        $event->name = $amazonRequest['name'];

        foreach ($amazonRequest['inputEvents'] as $_event) {
            $event->inputEvents[] = InputEvent::fromAmazonRequest($_event);
        }

        return $event;
    }
}
