<?php

namespace MaxBeckers\AmazonAlexa\Test\Intent;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Intent\Slot;
use PHPUnit\Framework\TestCase;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class IntentTest extends TestCase
{
    public function testWithoutResolutions()
    {
        $json   = file_get_contents(__DIR__.'/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($intent));
    }

    public function testWithResolutions()
    {
        $json   = file_get_contents(__DIR__.'/Data/intent_resolution.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($intent));
    }

    public function testGetResolutionByName()
    {
        $json   = file_get_contents(__DIR__.'/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));
        $slot   = $intent->getSlotByName('Age');
        $this->assertInstanceOf(Slot::class, $slot);
        $this->assertSame('Age', $slot->name);
        $slot = $intent->getSlotByName('age');
        $this->assertNull($slot);
        $slot = $intent->getSlotByName('Gender');
        $this->assertInstanceOf(Slot::class, $slot);
        $this->assertSame('Gender', $slot->name);
    }
}
