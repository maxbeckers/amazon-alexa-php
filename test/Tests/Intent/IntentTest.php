<?php

use PHPUnit\Framework\TestCase;
use MaxBeckers\AmazonAlexa\Intent\Slot;
use \MaxBeckers\AmazonAlexa\Intent\Intent;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class IntentTest extends TestCase
{
    public function testSlotMediaType()
    {
        $json = file_get_contents(__DIR__.'/Data/slot_media_type.json');
        $slot = Slot::fromAmazonRequest("MediaType", json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($slot));
    }

    public function testSlottoCity()
    {
        $json = file_get_contents(__DIR__.'/Data/slot_to_city.json');
        $slot = Slot::fromAmazonRequest("toCity", json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($slot));
    }

    public function testWithoutResolutions()
    {
        $json = file_get_contents(__DIR__.'/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($intent));
    }

    public function testWithResolutions()
    {
        $json = file_get_contents(__DIR__.'/Data/intent_resolution.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));
        $this->assertJsonStringEqualsJsonString($json, json_encode($intent));
    }
}