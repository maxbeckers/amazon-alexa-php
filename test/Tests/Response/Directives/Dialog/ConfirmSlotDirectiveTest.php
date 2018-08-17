<?php

namespace MaxBeckers\AmazonAlexa\Tests;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\ConfirmSlotDirective;
use PHPUnit\Framework\TestCase;

/**
 * @author Peter <peter279k@gmail.com>
 */
class ConfirmSlotDirectiveTest extends TestCase
{
    public function testCreate()
    {
        $confirmSlotDirective = ConfirmSlotDirective::create('');
        $this->assertSame('Dialog.ConfirmSlot', $confirmSlotDirective->type);
    }

    public function testCreateWithIntent()
    {
        $json   = file_get_contents(__DIR__.'/../../../Intent/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));

        $confirmSlotDirective = ConfirmSlotDirective::create('', $intent);
        $this->assertSame('Dialog.ConfirmSlot', $confirmSlotDirective->type);
    }
}
