<?php

namespace MaxBeckers\AmazonAlexa\Tests;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\DelegateDirective;
use PHPUnit\Framework\TestCase;

/**
 * @author Peter <peter279k@gmail.com>
 */
class DelegateDirectiveTest extends TestCase
{
    public function testCreate()
    {
        $delegateDirective = DelegateDirective::create();
        $this->assertSame('Dialog.Delegate', $delegateDirective->type);
    }

    public function testCreateWithIntent()
    {
        $json   = file_get_contents(__DIR__.'/../../../Intent/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));

        $delegateDirective = DelegateDirective::create($intent);
        $this->assertSame('Dialog.Delegate', $delegateDirective->type);
    }
}
