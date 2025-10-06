<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\MediaState;
use MaxBeckers\AmazonAlexa\Request\TrackedChange;
use PHPUnit\Framework\TestCase;

class TrackedChangeTest extends TestCase
{
    public function testFromAmazonRequestFullMapping(): void
    {
        $request = [
            'uid' => 'u123',
            'name' => 'PlaybackState',
            'from' => MediaState::PLAYING->value,
            'to' => MediaState::PAUSED->value,
            'utcTime' => '2024-12-01T12:34:56Z',
        ];

        $change = TrackedChange::fromAmazonRequest($request);

        $this->assertSame('u123', $change->uid);
        $this->assertSame('PlaybackState', $change->name);
        $this->assertSame(MediaState::PLAYING, $change->from);
        $this->assertSame(MediaState::PAUSED, $change->to);
        $this->assertSame('2024-12-01T12:34:56Z', $change->utcTime);
    }

    public function testFromAmazonRequestMissingFields(): void
    {
        $change = TrackedChange::fromAmazonRequest([]);

        $this->assertNull($change->uid);
        $this->assertNull($change->name);
        $this->assertNull($change->from);
        $this->assertNull($change->to);
        $this->assertNull($change->utcTime);
    }

    public function testFromAmazonRequestInvalidEnumValues(): void
    {
        $change = TrackedChange::fromAmazonRequest([
            'from' => 'NOPE',
            'to' => 'NAH',
        ]);

        $this->assertNull($change->from);
        $this->assertNull($change->to);
    }
}
