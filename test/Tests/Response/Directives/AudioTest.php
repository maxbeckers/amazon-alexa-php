<?php

use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\AudioItem;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\ClearDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\PlayDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\StopDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\Stream;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class AudioTest extends TestCase
{
    public function testStream()
    {
        $stream = Stream::create('testurl', 'token');
        $this->assertInstanceOf(Stream::class, $stream);
        $this->assertSame('testurl', $stream->url);
        $this->assertSame('token', $stream->token);

        $json = [
            'url'   => 'testurl',
            'token' => 'token',
        ];

        $this->assertSame($json, $stream->jsonSerialize());
    }

    public function testStreamAll()
    {
        $stream = Stream::create('testurl', 'token', 'prevToken', 10);
        $this->assertInstanceOf(Stream::class, $stream);
        $this->assertSame('testurl', $stream->url);
        $this->assertSame('token', $stream->token);
        $this->assertSame('prevToken', $stream->expectedPreviousToken);
        $this->assertSame(10, $stream->offsetInMilliseconds);

        $json = [
            'url'                   => 'testurl',
            'token'                 => 'token',
            'expectedPreviousToken' => 'prevToken',
            'offsetInMilliseconds'  => 10,
        ];

        $this->assertSame($json, $stream->jsonSerialize());
    }

    public function testAudioItem()
    {
        $stream    = Stream::create('testurl', 'token');
        $audioItem = AudioItem::create($stream);
        $this->assertInstanceOf(AudioItem::class, $audioItem);
        $this->assertSame($stream, $audioItem->stream);
    }

    public function testPlayDirective()
    {
        $stream        = Stream::create('testurl', 'token');
        $audioItem     = AudioItem::create($stream);
        $playDirective = PlayDirective::create($audioItem);
        $this->assertInstanceOf(PlayDirective::class, $playDirective);
        $this->assertSame(PlayDirective::TYPE, $playDirective->type);
        $this->assertSame($audioItem, $playDirective->audioItem);
        $this->assertSame(PlayDirective::PLAY_BEHAVIOR_REPLACE_ALL, $playDirective->playBehavior);
    }

    public function testPlayDirectiveBehavior()
    {
        $stream        = Stream::create('testurl', 'token');
        $audioItem     = AudioItem::create($stream);
        $playDirective = PlayDirective::create($audioItem, PlayDirective::PLAY_BEHAVIOR_REPLACE_ENQUEUED);
        $this->assertInstanceOf(PlayDirective::class, $playDirective);
        $this->assertSame($audioItem, $playDirective->audioItem);
        $this->assertSame(PlayDirective::PLAY_BEHAVIOR_REPLACE_ENQUEUED, $playDirective->playBehavior);
    }

    public function testClearDirective()
    {
        $clearDirective = ClearDirective::create(ClearDirective::CLEAR_BEHAVIOR_CLEAR_ALL);
        $this->assertInstanceOf(ClearDirective::class, $clearDirective);
        $this->assertSame(ClearDirective::TYPE, $clearDirective->type);
        $this->assertSame(ClearDirective::CLEAR_BEHAVIOR_CLEAR_ALL, $clearDirective->clearBehavior);
    }

    public function testStopDirective()
    {
        $stopDirective = StopDirective::create();
        $this->assertInstanceOf(StopDirective::class, $stopDirective);
        $this->assertSame(StopDirective::TYPE, $stopDirective->type);
    }
}
