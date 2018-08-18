<?php

namespace MaxBeckers\AmazonAlexa\Tests;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\ConfirmIntentDirective;
use PHPUnit\Framework\TestCase;

/**
 * @author Peter <peter279k@gmail.com>
 */
class ConfirmIntentDirectiveTest extends TestCase
{
    public function testCreate()
    {
        $confirmIntentDirective = ConfirmIntentDirective::create();
        $this->assertSame('Dialog.ConfirmIntent', $confirmIntentDirective->type);
    }

    public function testCreateWithIntent()
    {
        $json   = file_get_contents(__DIR__.'/../../../Intent/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));

        $confirmIntentDirective = ConfirmIntentDirective::create($intent);
        $this->assertSame('Dialog.ConfirmIntent', $confirmIntentDirective->type);
    }
}
