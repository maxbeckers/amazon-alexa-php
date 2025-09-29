<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\DelegateDirective;
use PHPUnit\Framework\TestCase;

class DelegateDirectiveTest extends TestCase
{
    public function testCreate(): void
    {
        $delegateDirective = DelegateDirective::create();
        $this->assertSame('Dialog.Delegate', $delegateDirective->type);
    }

    public function testCreateWithIntent(): void
    {
        $json = file_get_contents(__DIR__ . '/../../../Intent/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));

        $delegateDirective = DelegateDirective::create($intent);
        $this->assertSame('Dialog.Delegate', $delegateDirective->type);
    }
}
