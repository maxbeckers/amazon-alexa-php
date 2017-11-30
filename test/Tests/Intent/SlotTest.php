<?php

use PHPUnit\Framework\TestCase;
use MaxBeckers\AmazonAlexa\Intent\Slot;

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
}