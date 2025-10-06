<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Request\AudioTrack;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\PlayMediaCommand;
use PHPUnit\Framework\TestCase;

class PlayMediaCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myVideoPlayer';
        $source = 'https://example.com/video.mp4';
        $audioTrack = AudioTrack::FOREGROUND;

        $command = new PlayMediaCommand($componentId, $source, $audioTrack);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($source, $command->source);
        $this->assertSame($audioTrack, $command->audioTrack);
    }

    public function testConstructorWithArraySource(): void
    {
        $componentId = 'player';
        $source = [
            'https://example.com/video1.mp4',
            'https://example.com/video2.mp4',
        ];
        $audioTrack = AudioTrack::BACKGROUND;

        $command = new PlayMediaCommand($componentId, $source, $audioTrack);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($source, $command->source);
        $this->assertSame($audioTrack, $command->audioTrack);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new PlayMediaCommand();

        $this->assertNull($command->componentId);
        $this->assertNull($command->source);
        $this->assertNull($command->audioTrack);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testPlayer';
        $source = 'https://test.com/media.mp3';
        $audioTrack = AudioTrack::FOREGROUND;

        $command = new PlayMediaCommand($componentId, $source, $audioTrack);
        $result = $command->jsonSerialize();

        $this->assertSame(PlayMediaCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($source, $result['source']);
        $this->assertSame($audioTrack->value, $result['audioTrack']);
    }

    public function testJsonSerializeWithArraySource(): void
    {
        $source = ['url1.mp4', 'url2.mp4'];
        $command = new PlayMediaCommand('player', $source);
        $result = $command->jsonSerialize();

        $this->assertSame(PlayMediaCommand::TYPE, $result['type']);
        $this->assertSame('player', $result['componentId']);
        $this->assertSame($source, $result['source']);
        $this->assertArrayNotHasKey('audioTrack', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new PlayMediaCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(PlayMediaCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('source', $result);
        $this->assertArrayNotHasKey('audioTrack', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = new PlayMediaCommand('player1', 'source.mp4');
        $result = $command->jsonSerialize();

        $this->assertSame(PlayMediaCommand::TYPE, $result['type']);
        $this->assertSame('player1', $result['componentId']);
        $this->assertSame('source.mp4', $result['source']);
        $this->assertArrayNotHasKey('audioTrack', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('PlayMedia', PlayMediaCommand::TYPE);
    }
}
