<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\AudioTrack;
use MaxBeckers\AmazonAlexa\Request\MediaState;
use MaxBeckers\AmazonAlexa\Request\MediaTag;
use PHPUnit\Framework\TestCase;

class MediaTagTest extends TestCase
{
    public function testFullMapping(): void
    {
        $request = [
            'allowAdjustSeekPositionForward' => true,
            'allowAdjustSeekPositionBackwards' => false,
            'allowNext' => true,
            'allowPrevious' => false,
            'audioTrack' => AudioTrack::BACKGROUND->value,
            'entities' => [
                ['name' => 'entity1'],
                ['name' => 'entity2'],
            ],
            'muted' => true,
            'positionInMilliseconds' => 12345,
            'state' => MediaState::PAUSED->value,
            'url' => 'https://example.com/audio.mp3',
        ];

        $tag = MediaTag::fromAmazonRequest($request);

        $this->assertTrue($tag->allowAdjustSeekPositionForward);
        $this->assertFalse($tag->allowAdjustSeekPositionBackwards);
        $this->assertTrue($tag->allowNext);
        $this->assertFalse($tag->allowPrevious);
        $this->assertSame(AudioTrack::BACKGROUND, $tag->audioTrack);
        $this->assertCount(2, $tag->entities);
        $this->assertTrue($tag->muted);
        $this->assertSame(12345, $tag->positionInMilliseconds);
        $this->assertSame(MediaState::PAUSED, $tag->state);
        $this->assertSame('https://example.com/audio.mp3', $tag->url);
    }

    public function testMissingFieldsDefaults(): void
    {
        $tag = MediaTag::fromAmazonRequest([]);

        $this->assertNull($tag->audioTrack);
        $this->assertSame([], $tag->entities);
        $this->assertNull($tag->state);
        $this->assertNull($tag->allowNext);
        $this->assertNull($tag->url);
    }

    public function testInvalidEnumValuesBecomeNull(): void
    {
        $tag = MediaTag::fromAmazonRequest([
            'audioTrack' => 'INVALID_TRACK',
            'state' => 'INVALID_STATE',
        ]);

        $this->assertNull($tag->audioTrack);
        $this->assertNull($tag->state);
    }

    public function testEntitiesParsedEvenIfEmptyArray(): void
    {
        $tag = MediaTag::fromAmazonRequest(['entities' => []]);

        $this->assertIsArray($tag->entities);
        $this->assertCount(0, $tag->entities);
    }
}
