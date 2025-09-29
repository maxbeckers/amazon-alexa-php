<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\ConfirmIntentDirective;
use PHPUnit\Framework\TestCase;

class ConfirmIntentDirectiveTest extends TestCase
{
    public function testCreate(): void
    {
        $confirmIntentDirective = ConfirmIntentDirective::create();
        $this->assertSame('Dialog.ConfirmIntent', $confirmIntentDirective->type);
    }

    public function testCreateWithIntent(): void
    {
        $json = file_get_contents(__DIR__ . '/../../../Intent/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));

        $confirmIntentDirective = ConfirmIntentDirective::create($intent);
        $this->assertSame('Dialog.ConfirmIntent', $confirmIntentDirective->type);
    }
}
