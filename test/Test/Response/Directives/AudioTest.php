<?php

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives;

use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\AudioItem;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\ClearDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\Metadata;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\PlayDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\StopDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\Stream;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\Image;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\ImageSource;
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

        $json = new \ArrayObject([
            'url'   => 'testurl',
            'token' => 'token',
        ]);

        $this->assertEquals($json, $stream->jsonSerialize());
    }

    public function testStreamAll()
    {
        $stream = Stream::create('testurl', 'token', 'prevToken', 10);
        $this->assertInstanceOf(Stream::class, $stream);
        $this->assertSame('testurl', $stream->url);
        $this->assertSame('token', $stream->token);
        $this->assertSame('prevToken', $stream->expectedPreviousToken);
        $this->assertSame(10, $stream->offsetInMilliseconds);

        $json = new \ArrayObject([
            'url'                   => 'testurl',
            'token'                 => 'token',
            'expectedPreviousToken' => 'prevToken',
            'offsetInMilliseconds'  => 10,
        ]);

        $this->assertEquals($json, $stream->jsonSerialize());
    }

    public function testAudioItem()
    {
        $stream    = Stream::create('testurl', 'token');
        $audioItem = AudioItem::create($stream);
        $this->assertInstanceOf(AudioItem::class, $audioItem);
        $this->assertSame($stream, $audioItem->stream);
    }

    public function testAudioItemWithMetadata()
    {
        $art             = Image::create(null, ImageSource::create('https://url-of-the-album-art-image.png'));
        $backgroundImage = Image::create(null, ImageSource::create('https://url-of-the-background-image.png'));

        $stream   = Stream::create('https://url-of-the-stream-to-play', 'opaque token representing this stream', 'opaque token representing the previous stream', 0);
        $metadata = Metadata::create('title of the track to display', 'subtitle of the track to display', $art, $backgroundImage);

        $audioItem = AudioItem::create($stream, $metadata);
        $this->assertEquals([
            'stream'   => $stream,
            'metadata' => $metadata,
        ], $audioItem->jsonSerialize());
        $this->assertSame('{"stream":{"url":"https:\/\/url-of-the-stream-to-play","token":"opaque token representing this stream","expectedPreviousToken":"opaque token representing the previous stream","offsetInMilliseconds":0},"metadata":{"title":"title of the track to display","subtitle":"subtitle of the track to display","art":{"contentDescription":null,"sources":{"url":"https:\/\/url-of-the-album-art-image.png"}},"backgroundImage":{"contentDescription":null,"sources":{"url":"https:\/\/url-of-the-background-image.png"}}}}', json_encode($audioItem));
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
