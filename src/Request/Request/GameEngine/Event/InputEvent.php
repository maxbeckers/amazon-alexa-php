<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class InputEvent
{
    const ACTION_DOWN = 'down';
    const ACTION_UP   = 'up';

    /**
     * @var string
     */
    public $gadgetId;

    /**
     * @var \DateTime
     */
    public $timestamp;

    /**
     * @var string
     */
    public $action;

    /**
     * @var string
     */
    public $color;

    /**
     * @var string
     */
    public $feature;

    /**
     * @param array $amazonRequest
     *
     * @throws \Exception
     *
     * @return InputEvent
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $event = new self();

        $event->gadgetId  = $amazonRequest['gadgetId'];
        $event->timestamp = new \DateTime($amazonRequest['timestamp']);
        $event->action    = $amazonRequest['action'];
        $event->color     = $amazonRequest['color'];
        $event->feature   = $amazonRequest['feature'];

        return $event;
    }
}
