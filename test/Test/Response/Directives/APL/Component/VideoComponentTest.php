<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\VideoComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AudioTrack;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Scale;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class VideoComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $audioTrack = AudioTrack::FOREGROUND;
        $onEnd = [$this->createMock(AbstractStandardCommand::class)];
        $onPause = [$this->createMock(AbstractStandardCommand::class)];
        $onPlay = [$this->createMock(AbstractStandardCommand::class)];
        $onTimeUpdate = [$this->createMock(AbstractStandardCommand::class)];
        $onTrackUpdate = [$this->createMock(AbstractStandardCommand::class)];
        $onTrackReady = [$this->createMock(AbstractStandardCommand::class)];
        $onTrackFail = [$this->createMock(AbstractStandardCommand::class)];
        $preserve = ['playbackPosition', 'volume'];
        $scale = Scale::FILL;
        $source = 'https://example.com/video.mp4';
        $sources = ['https://example.com/video1.mp4', 'https://example.com/video2.mp4'];
        $trackChanges = ['position', 'state'];

        $component = new VideoComponent(
            $audioTrack,
            true, // autoplay
            true, // muted
            $onEnd,
            $onPause,
            $onPlay,
            $onTimeUpdate,
            $onTrackUpdate,
            $onTrackReady,
            $onTrackFail,
            $preserve,
            $scale,
            false, // screenLock
            $source,
            $sources,
            $trackChanges
        );

        $this->assertSame($audioTrack, $component->audioTrack);
        $this->assertTrue($component->autoplay);
        $this->assertTrue($component->muted);
        $this->assertSame($onEnd, $component->onEnd);
        $this->assertSame($onPause, $component->onPause);
        $this->assertSame($onPlay, $component->onPlay);
        $this->assertSame($onTimeUpdate, $component->onTimeUpdate);
        $this->assertSame($onTrackUpdate, $component->onTrackUpdate);
        $this->assertSame($onTrackReady, $component->onTrackReady);
        $this->assertSame($onTrackFail, $component->onTrackFail);
        $this->assertSame($preserve, $component->preserve);
        $this->assertSame($scale, $component->scale);
        $this->assertFalse($component->screenLock);
        $this->assertSame($source, $component->source);
        $this->assertSame($sources, $component->sources);
        $this->assertSame($trackChanges, $component->trackChanges);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new VideoComponent();

        $this->assertNull($component->audioTrack);
        $this->assertFalse($component->autoplay);
        $this->assertFalse($component->muted);
        $this->assertNull($component->onEnd);
        $this->assertNull($component->onPause);
        $this->assertNull($component->onPlay);
        $this->assertNull($component->onTimeUpdate);
        $this->assertNull($component->onTrackUpdate);
        $this->assertNull($component->onTrackReady);
        $this->assertNull($component->onTrackFail);
        $this->assertNull($component->preserve);
        $this->assertNull($component->scale);
        $this->assertTrue($component->screenLock);
        $this->assertNull($component->source);
        $this->assertNull($component->sources);
        $this->assertNull($component->trackChanges);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $audioTrack = AudioTrack::BACKGROUND;
        $onEnd = [$this->createMock(AbstractStandardCommand::class)];
        $onPause = [$this->createMock(AbstractStandardCommand::class)];
        $onPlay = [$this->createMock(AbstractStandardCommand::class)];
        $onTimeUpdate = [$this->createMock(AbstractStandardCommand::class)];
        $onTrackUpdate = [$this->createMock(AbstractStandardCommand::class)];
        $onTrackReady = [$this->createMock(AbstractStandardCommand::class)];
        $onTrackFail = [$this->createMock(AbstractStandardCommand::class)];
        $preserve = ['state'];
        $scale = Scale::BEST_FIT;
        $source = ['url1.mp4', 'url2.mp4'];
        $sources = [['url' => 'video1.mp4'], ['url' => 'video2.mp4']];
        $trackChanges = ['playback'];

        $component = new VideoComponent(
            audioTrack: $audioTrack,
            autoplay: true,
            muted: true,
            onEnd: $onEnd,
            onPause: $onPause,
            onPlay: $onPlay,
            onTimeUpdate: $onTimeUpdate,
            onTrackUpdate: $onTrackUpdate,
            onTrackReady: $onTrackReady,
            onTrackFail: $onTrackFail,
            preserve: $preserve,
            scale: $scale,
            screenLock: false,
            source: $source,
            sources: $sources,
            trackChanges: $trackChanges
        );

        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::VIDEO->value, $result['type']);
        $this->assertSame($audioTrack->value, $result['audioTrack']);
        $this->assertTrue($result['autoplay']);
        $this->assertTrue($result['muted']);
        $this->assertSame($onEnd, $result['onEnd']);
        $this->assertSame($onPause, $result['onPause']);
        $this->assertSame($onPlay, $result['onPlay']);
        $this->assertSame($onTimeUpdate, $result['onTimeUpdate']);
        $this->assertSame($onTrackUpdate, $result['onTrackUpdate']);
        $this->assertSame($onTrackReady, $result['onTrackReady']);
        $this->assertSame($onTrackFail, $result['onTrackFail']);
        $this->assertSame($preserve, $result['preserve']);
        $this->assertSame($scale->value, $result['scale']);
        $this->assertFalse($result['screenLock']);
        $this->assertSame($source, $result['source']);
        $this->assertSame($sources, $result['sources']);
        $this->assertSame($trackChanges, $result['trackChanges']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $component = new VideoComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::VIDEO->value, $result['type']);
        $this->assertArrayNotHasKey('audioTrack', $result);
        $this->assertArrayNotHasKey('autoplay', $result);
        $this->assertArrayNotHasKey('muted', $result);
        $this->assertArrayNotHasKey('screenLock', $result); // true is default, so not included
    }

    public function testJsonSerializeWithBooleanProperties(): void
    {
        $component = new VideoComponent(
            autoplay: true,
            muted: true,
            screenLock: false
        );
        $result = $component->jsonSerialize();

        $this->assertTrue($result['autoplay']);
        $this->assertTrue($result['muted']);
        $this->assertFalse($result['screenLock']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $component = new VideoComponent(
            onEnd: [],
            onPause: [],
            onPlay: [],
            onTimeUpdate: [],
            onTrackUpdate: [],
            onTrackReady: [],
            onTrackFail: [],
            preserve: [],
            sources: [],
            trackChanges: []
        );
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('onEnd', $result);
        $this->assertArrayNotHasKey('onPause', $result);
        $this->assertArrayNotHasKey('onPlay', $result);
        $this->assertArrayNotHasKey('onTimeUpdate', $result);
        $this->assertArrayNotHasKey('onTrackUpdate', $result);
        $this->assertArrayNotHasKey('onTrackReady', $result);
        $this->assertArrayNotHasKey('onTrackFail', $result);
        $this->assertArrayNotHasKey('preserve', $result);
        $this->assertArrayNotHasKey('sources', $result);
        $this->assertArrayNotHasKey('trackChanges', $result);
    }

    public function testJsonSerializeWithStringSource(): void
    {
        $component = new VideoComponent(source: 'video.mp4');
        $result = $component->jsonSerialize();

        $this->assertSame('video.mp4', $result['source']);
    }

    public function testJsonSerializeWithArraySource(): void
    {
        $source = ['primary.mp4', 'fallback.mp4'];
        $component = new VideoComponent(source: $source);
        $result = $component->jsonSerialize();

        $this->assertSame($source, $result['source']);
    }

    public function testJsonSerializeWithDifferentAudioTracks(): void
    {
        $audioTracks = [AudioTrack::FOREGROUND, AudioTrack::BACKGROUND];

        foreach ($audioTracks as $track) {
            $component = new VideoComponent(audioTrack: $track);
            $result = $component->jsonSerialize();

            $this->assertSame($track->value, $result['audioTrack']);
        }
    }

    public function testJsonSerializeWithDifferentScaleValues(): void
    {
        $scaleValues = [Scale::FILL, Scale::BEST_FIT, Scale::NONE];

        foreach ($scaleValues as $scale) {
            $component = new VideoComponent(scale: $scale);
            $result = $component->jsonSerialize();

            $this->assertSame($scale->value, $result['scale']);
        }
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::VIDEO, VideoComponent::TYPE);
    }

    public function testExtendsAPLBaseComponent(): void
    {
        $component = new VideoComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new VideoComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
