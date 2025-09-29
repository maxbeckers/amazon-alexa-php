<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Intent;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Intent\Slot;
use PHPUnit\Framework\TestCase;

class IntentTest extends TestCase
{
    public function testWithoutResolutions(): void
    {
        $json = file_get_contents(__DIR__ . '/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($intent));
    }

    public function testWithResolutions(): void
    {
        $json = file_get_contents(__DIR__ . '/Data/intent_resolution.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($intent));
    }

    public function testGetResolutionByName(): void
    {
        $json = file_get_contents(__DIR__ . '/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));
        $slot = $intent->getSlotByName('Age');
        $this->assertInstanceOf(Slot::class, $slot);
        $this->assertSame('Age', $slot->name);
        $slot = $intent->getSlotByName('age');
        $this->assertNull($slot);
        $slot = $intent->getSlotByName('Gender');
        $this->assertInstanceOf(Slot::class, $slot);
        $this->assertSame('Gender', $slot->name);
    }
}
