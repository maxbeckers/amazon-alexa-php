<?php

namespace MaxBeckers\AmazonAlexa\Tests;

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
            'test_match'     => RecognizerMatch::create(RecognizerMatch::ANCHOR_START, false, ['gadgetId1', 'gadgetId2'], [Pattern::ACTION_UP], [$pattern]),
            'test_deviation' => RecognizerDeviation::create('test_match'),
            'test_progress'  => RecognizerProgress::create('test_match', 5),
        ];
        $events      = [
            'test_match' => Event::create(['test_match'], true, ['test_deviation'], Event::REPORTS_HISTORY, 1, 1000),
        ];

        $startInputHandlerDirective = StartInputHandlerDirective::create(5000, $recognizers, $events);
        $this->assertSame('GameEngine.StartInputHandler', $startInputHandlerDirective->type);
        $this->assertSame(5000, $startInputHandlerDirective->timeout);
        $this->assertSame('match', $startInputHandlerDirective->recognizers['test_match']->type);
        $this->assertSame(Event::REPORTS_HISTORY, $startInputHandlerDirective->events['test_match']->reports);
    }

    public function testStopInputHandlerDirective()
    {
        $startInputHandlerDirective = StopInputHandlerDirective::create('originatingRequestId');
        $this->assertSame('GameEngine.StopInputHandler', $startInputHandlerDirective->type);
        $this->assertSame('originatingRequestId', $startInputHandlerDirective->originatingRequestId);
    }
}
