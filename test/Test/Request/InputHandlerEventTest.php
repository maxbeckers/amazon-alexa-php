<?php

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event\Event;
use MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event\InputEvent;
use MaxBeckers\AmazonAlexa\Request\Request\GameEngine\InputHandlerEvent;
use PHPUnit\Framework\TestCase;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class InputHandlerEventTest extends TestCase
{
    /**
     * @throws \MaxBeckers\AmazonAlexa\Exception\MissingRequestDataException
     * @throws \MaxBeckers\AmazonAlexa\Exception\MissingRequiredHeaderException
     * @covers \MaxBeckers\AmazonAlexa\Request\Request\GameEngine\InputHandlerEvent::fromAmazonRequest
     * @covers \MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event\Event::fromAmazonRequest
     * @covers \MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event\InputEvent::fromAmazonRequest
     */
    public function testIntentRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/inputHandlerEvent.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        /**
         * @var InputHandlerEvent
         */
        $inputHandlerEvent = $request->request;
        $this->assertInstanceOf(InputHandlerEvent::class, $inputHandlerEvent);
        $this->assertSame('amzn1.ask.skill.0000000-0000-0000-0000-00000000000', $request->context->system->application->applicationId);
        $this->assertCount(1, $inputHandlerEvent->events);
        $this->assertIsArray($inputHandlerEvent->events);
        /**
         * @var Event
         */
        $event = $inputHandlerEvent->events[0];
        $this->assertInstanceOf(Event::class, $event);
        $this->assertSame('testEvent', $event->name);
        $this->assertCount(2, $event->inputEvents);
        $this->assertIsArray($event->inputEvents);
        /**
         * @var InputEvent;
         */
        $inputEvent = $event->inputEvents[0];
        $this->assertInstanceOf(InputEvent::class, $inputEvent);
        $this->assertSame('amzn1.ask.gadget.AAAAA', $inputEvent->gadgetId);
        $this->assertInstanceOf(\DateTime::class, $inputEvent->timestamp);
        $this->assertSame('2019-03-05T13:46:21+00:00', $inputEvent->timestamp->format('c'));
        $this->assertSame(InputEvent::ACTION_DOWN, $inputEvent->action);
        $this->assertSame('000000', $inputEvent->color);
        $this->assertSame('press', $inputEvent->feature);
    }
}
