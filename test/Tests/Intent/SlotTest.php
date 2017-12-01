<?php

use PHPUnit\Framework\TestCase;
use MaxBeckers\AmazonAlexa\Intent\Slot;
use MaxBeckers\AmazonAlexa\Intent\IntentValue;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class SlotTest extends TestCase
{
    /**
     * @covers Slot::fromAmazonRequest()
     * @covers Slot::jsonSerialize()
     */
    public function testSlotMediaType()
    {
        $json = file_get_contents(__DIR__.'/Data/slot_media_type.json');
        $slot = Slot::fromAmazonRequest("MediaType", json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($slot));
    }

    /**
     * @covers Slot::fromAmazonRequest()
     * @covers Slot::jsonSerialize()
     */
    public function testSlottoCity()
    {
        $json = file_get_contents(__DIR__.'/Data/slot_to_city.json');
        $slot = Slot::fromAmazonRequest("toCity", json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($slot));
    }

    /**
     * @covers Slot::getFirstResolutionIntentValue()
     */
    public function testGetFirstResolutionIntentValue()
    {
        $json = file_get_contents(__DIR__.'/Data/slot_to_city.json');
        $slot = Slot::fromAmazonRequest("toCity", json_decode($json, true));
        $intentValue = $slot->getFirstResolutionIntentValue();
        $this->assertInstanceOf(IntentValue::class, $intentValue);
        $this->assertEquals("chicago", $intentValue->name);
        $this->assertEquals("ORD", $intentValue->id);
        $json = file_get_contents(__DIR__.'/Data/slot_no_resolution.json');
        $slot = Slot::fromAmazonRequest("toCity", json_decode($json, true));
        $this->assertNull($slot->getFirstResolutionIntentValue());
    }
}