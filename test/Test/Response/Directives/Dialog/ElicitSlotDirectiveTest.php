<?php

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\ElicitSlotDirective;
use PHPUnit\Framework\TestCase;

/**
 * @author Peter <peter279k@gmail.com>
 */
class ElicitSlotDirectiveTest extends TestCase
{
    public function testCreate()
    {
        $elicitSlotDirective = ElicitSlotDirective::create('');
        $this->assertSame('Dialog.ElicitSlot', $elicitSlotDirective->type);
    }

    public function testCreateWithIntent()
    {
        $json   = file_get_contents(__DIR__.'/../../../Intent/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));

        $elicitSlotDirective = ElicitSlotDirective::create('', $intent);
        $this->assertSame('Dialog.ElicitSlot', $elicitSlotDirective->type);
    }
}
