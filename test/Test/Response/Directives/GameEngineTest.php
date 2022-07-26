<?php

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives;

use MaxBeckers\AmazonAlexa\Response\Directives\GameEngine\Event;
use MaxBeckers\AmazonAlexa\Response\Directives\GameEngine\Pattern;
use MaxBeckers\AmazonAlexa\Response\Directives\GameEngine\RecognizerDeviation;
use MaxBeckers\AmazonAlexa\Response\Directives\GameEngine\RecognizerMatch;
use MaxBeckers\AmazonAlexa\Response\Directives\GameEngine\RecognizerProgress;
use MaxBeckers\AmazonAlexa\Response\Directives\GameEngine\StartInputHandlerDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\GameEngine\StopInputHandlerDirective;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class GameEngineTest extends TestCase
{
    public function testStartInputHandlerDirective()
    {
        $pattern = Pattern::create(Pattern::ACTION_UP, ['gadgetId1', 'gadgetId2'], ['blue']);

        $recognizers = [
            'test_match'     => RecognizerMatch::create([Pattern::ACTION_UP], RecognizerMatch::ANCHOR_START, false, ['gadgetId1', 'gadgetId2'], [$pattern]),
            'test_deviation' => RecognizerDeviation::create('test_match'),
            'test_progress'  => RecognizerProgress::create('test_match', 5),
        ];
        $events = [
            'test_match' => Event::create(['test_match'], true, ['test_deviation'], Event::REPORTS_HISTORY, 1, 1000),
        ];

        $startInputHandlerDirective = StartInputHandlerDirective::create(5000, $recognizers, $events);
        $this->assertSame('GameEngine.StartInputHandler', $startInputHandlerDirective->type);
        $this->assertSame(5000, $startInputHandlerDirective->timeout);
        $this->assertSame('match', $startInputHandlerDirective->recognizers['test_match']->type);
        $this->assertSame(Event::REPORTS_HISTORY, $startInputHandlerDirective->events['test_match']->reports);
    }

    public function testPattern()
    {
        $pattern = Pattern::create(Pattern::ACTION_UP, ['gadgetId1', 'gadgetId2'], ['blue']);
        $this->assertJsonStringEqualsJsonString('{"gadgetIds":["gadgetId1","gadgetId2"],"colors":["blue"],"action":"up","repeat":null}', json_encode($pattern));
        $pattern = Pattern::create(Pattern::ACTION_UP, null, null, 10);
        $this->assertJsonStringEqualsJsonString('{"gadgetIds":null,"colors":null,"action":"up","repeat":10}', json_encode($pattern));
    }

    public function testStopInputHandlerDirective()
    {
        $startInputHandlerDirective = StopInputHandlerDirective::create('originatingRequestId');
        $this->assertSame('GameEngine.StopInputHandler', $startInputHandlerDirective->type);
        $this->assertSame('originatingRequestId', $startInputHandlerDirective->originatingRequestId);
    }
}
