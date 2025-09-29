<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\GameEngine;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event\Event;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\StandardRequest;

class InputHandlerEvent extends StandardRequest
{
    public const TYPE = 'GameEngine.InputHandlerEvent';

    public string $originatingRequestId;

    /** @var Event[] */
    public array $events = [];

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->originatingRequestId = $amazonRequest['originatingRequestId'];
        foreach ($amazonRequest['events'] as $event) {
            $request->events[] = Event::fromAmazonRequest($event);
        }

        $request->setRequestData($amazonRequest);

        return $request;
    }
}
