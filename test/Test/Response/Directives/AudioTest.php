<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives;

use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\AudioItem;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\ClearDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\CurrentPlaybackState;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\Metadata;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\PlaybackFailed;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\PlaybackFinished;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\PlaybackNearlyFinished;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\PlaybackStarted;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\PlaybackStopped;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\PlayDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\StopDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer\Stream;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\Image;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\ImageSource;
use MaxBeckers\AmazonAlexa\Response\Directives\System\Error;
use PHPUnit\Framework\TestCase;

class AudioTest extends TestCase
{
    public function testStream(): void
    {
        $stream = Stream::create('testurl', 'token');
        $this->assertInstanceOf(Stream::class, $stream);
        $this->assertSame('testurl', $stream->url);
        $this->assertSame('token', $stream->token);

        $json = new \ArrayObject([
            'url' => 'testurl',
            'token' => 'token',
        ]);

        $this->assertEquals($json, $stream->jsonSerialize());
    }

    public function testStreamAll(): void
    {
        $stream = Stream::create('testurl', 'token', 'prevToken', 10);
        $this->assertInstanceOf(Stream::class, $stream);
        $this->assertSame('testurl', $stream->url);
        $this->assertSame('token', $stream->token);
        $this->assertSame('prevToken', $stream->expectedPreviousToken);
        $this->assertSame(10, $stream->offsetInMilliseconds);

        $json = new \ArrayObject([
            'url' => 'testurl',
            'token' => 'token',
            'expectedPreviousToken' => 'prevToken',
            'offsetInMilliseconds' => 10,
        ]);

        $this->assertEquals($json, $stream->jsonSerialize());
    }

    public function testAudioItem(): void
    {
        $stream = Stream::create('testurl', 'token');
        $audioItem = AudioItem::create($stream);
        $this->assertInstanceOf(AudioItem::class, $audioItem);
        $this->assertSame($stream, $audioItem->stream);
    }

    public function testAudioItemWithMetadata(): void
    {
        $art = Image::create(null, [ImageSource::create('https://url-of-the-album-art-image.png')]);
        $backgroundImage = Image::create(null, [ImageSource::create('https://url-of-the-background-image.png')]);

        $stream = Stream::create('https://url-of-the-stream-to-play', 'opaque token representing this stream', 'opaque token representing the previous stream', 0);
        $metadata = Metadata::create('title of the track to display', 'subtitle of the track to display', $art, $backgroundImage);

        $audioItem = AudioItem::create($stream, $metadata);
        $this->assertEquals([
            'stream' => $stream,
            'metadata' => $metadata,
        ], $audioItem->jsonSerialize());
        $this->assertSame('{"stream":{"url":"https:\/\/url-of-the-stream-to-play","token":"opaque token representing this stream","expectedPreviousToken":"opaque token representing the previous stream","offsetInMilliseconds":0},"metadata":{"title":"title of the track to display","subtitle":"subtitle of the track to display","art":{"contentDescription":null,"sources":[{"url":"https:\/\/url-of-the-album-art-image.png"}]},"backgroundImage":{"contentDescription":null,"sources":[{"url":"https:\/\/url-of-the-background-image.png"}]}}}', json_encode($audioItem));
    }

    public function testPlayDirective(): void
    {
        $stream = Stream::create('testurl', 'token');
        $audioItem = AudioItem::create($stream);
        $playDirective = PlayDirective::create($audioItem);
        $this->assertInstanceOf(PlayDirective::class, $playDirective);
        $this->assertSame(PlayDirective::TYPE, $playDirective->type);
        $this->assertSame($audioItem, $playDirective->audioItem);
        $this->assertSame(PlayDirective::PLAY_BEHAVIOR_REPLACE_ALL, $playDirective->playBehavior);
    }

    public function testPlayDirectiveBehavior(): void
    {
        $stream = Stream::create('testurl', 'token');
        $audioItem = AudioItem::create($stream);
        $playDirective = PlayDirective::create($audioItem, PlayDirective::PLAY_BEHAVIOR_REPLACE_ENQUEUED);
        $this->assertInstanceOf(PlayDirective::class, $playDirective);
        $this->assertSame($audioItem, $playDirective->audioItem);
        $this->assertSame(PlayDirective::PLAY_BEHAVIOR_REPLACE_ENQUEUED, $playDirective->playBehavior);
    }

    public function testClearDirective(): void
    {
        $clearDirective = ClearDirective::create(ClearDirective::CLEAR_BEHAVIOR_CLEAR_ALL);
        $this->assertInstanceOf(ClearDirective::class, $clearDirective);
        $this->assertSame(ClearDirective::TYPE, $clearDirective->type);
        $this->assertSame(ClearDirective::CLEAR_BEHAVIOR_CLEAR_ALL, $clearDirective->clearBehavior);
    }

    public function testStopDirective(): void
    {
        $stopDirective = StopDirective::create();
        $this->assertInstanceOf(StopDirective::class, $stopDirective);
        $this->assertSame(StopDirective::TYPE, $stopDirective->type);
    }

    public function testPlaybackStartedDirective(): void
    {
        $playbackStarted = PlaybackStarted::create('requestId', 'timestamp', 'token', 0, 'en-US');
        $this->assertInstanceOf(PlaybackStarted::class, $playbackStarted);
        $this->assertSame(PlaybackStarted::TYPE, $playbackStarted->type);
    }

    public function testPlaybackFinishedDirective(): void
    {
        $playbackFinished = PlaybackFinished::create('requestId', 'timestamp', 'token', 0, 'en-US');
        $this->assertInstanceOf(PlaybackFinished::class, $playbackFinished);
        $this->assertSame(PlaybackFinished::TYPE, $playbackFinished->type);
    }

    public function testPlaybackStoppedDirective(): void
    {
        $playbackStopped = PlaybackStopped::create('requestId', 'timestamp', 'token', 0, 'en-US');
        $this->assertInstanceOf(PlaybackStopped::class, $playbackStopped);
        $this->assertSame(PlaybackStopped::TYPE, $playbackStopped->type);
    }

    public function testPlaybackNearlyFinishedDirective(): void
    {
        $playbackNearlyFinished = PlaybackNearlyFinished::create('requestId', 'timestamp', 'token', 0, 'en-US');
        $this->assertInstanceOf(PlaybackNearlyFinished::class, $playbackNearlyFinished);
        $this->assertSame(PlaybackNearlyFinished::TYPE, $playbackNearlyFinished->type);
    }

    /**
     * @dataProvider getPlaybackFailed
     */
    public function testPlaybackFailedDirective(string $errorReason, string $playerActivity): void
    {
        $error = Error::create($errorReason, 'message');
        $currentPlaybackState = CurrentPlaybackState::create('token', 0, $playerActivity);
        $playbackFailed = PlaybackFailed::create('requestId', 'timestamp', 'token', 0, 'en-US', $error, $currentPlaybackState);
        $this->assertInstanceOf(PlaybackFailed::class, $playbackFailed);
        $this->assertSame(PlaybackFailed::TYPE, $playbackFailed->type);
        $this->assertSame($errorReason, $playbackFailed->error->type);
        $this->assertSame($playerActivity, $playbackFailed->currentPlaybackState->playerActivity);
    }

    public static function getPlaybackFailed(): array
    {
        return [
            [Error::MEDIA_ERROR_UNKNOWN, CurrentPlaybackState::PLAYER_ACTIVITY_PLAYING],
            [Error::MEDIA_ERROR_SERVICE_UNAVAILABLE, CurrentPlaybackState::PLAYER_ACTIVITY_FINISHED],
            [Error::MEDIA_ERROR_INVALID_REQUEST, CurrentPlaybackState::PLAYER_ACTIVITY_IDLE],
            [Error::MEDIA_ERROR_INTERNAL_SERVER_ERROR, CurrentPlaybackState::PLAYER_ACTIVITY_PAUSED],
            [Error::MEDIA_ERROR_INTERNAL_DEVICE_ERROR, CurrentPlaybackState::PLAYER_ACTIVITY_BUFFER_UNDERRUN],
        ];
    }
}
