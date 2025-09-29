<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Intent;

use MaxBeckers\AmazonAlexa\Intent\IntentValue;
use MaxBeckers\AmazonAlexa\Intent\Slot;
use PHPUnit\Framework\TestCase;

class SlotTest extends TestCase
{
    public function testSlotMediaType(): void
    {
        $json = file_get_contents(__DIR__ . '/Data/slot_media_type.json');
        $slot = Slot::fromAmazonRequest('MediaType', json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($slot));
    }

    public function testSlottoCity(): void
    {
        $json = file_get_contents(__DIR__ . '/Data/slot_to_city.json');
        $slot = Slot::fromAmazonRequest('toCity', json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($slot));
    }

    public function testGetFirstResolutionIntentValue(): void
    {
        $json = file_get_contents(__DIR__ . '/Data/slot_to_city.json');
        $slot = Slot::fromAmazonRequest('toCity', json_decode($json, true));
        $intentValue = $slot->getFirstResolutionIntentValue();
        $this->assertInstanceOf(IntentValue::class, $intentValue);
        $this->assertSame('chicago', $intentValue->name);
        $this->assertSame('ORD', $intentValue->id);
        $json = file_get_contents(__DIR__ . '/Data/slot_no_resolution.json');
        $slot = Slot::fromAmazonRequest('toCity', json_decode($json, true));
        $this->assertNull($slot->getFirstResolutionIntentValue());
    }
}
