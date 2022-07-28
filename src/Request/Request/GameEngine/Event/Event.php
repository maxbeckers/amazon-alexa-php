<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class Event
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $inputEvents = [];

    /**
     * @param array $amazonRequest
     *
     * @return Event
     * @throws \Exception
     *
     */
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
