<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\ConfirmSlotDirective;
use PHPUnit\Framework\TestCase;

class ConfirmSlotDirectiveTest extends TestCase
{
    public function testCreate(): void
    {
        $confirmSlotDirective = ConfirmSlotDirective::create('');
        $this->assertSame('Dialog.ConfirmSlot', $confirmSlotDirective->type);
    }

    public function testCreateWithIntent(): void
    {
        $json = file_get_contents(__DIR__ . '/../../../Intent/Data/intent_without_resolutions.json');
        $intent = Intent::fromAmazonRequest(json_decode($json, true));

        $confirmSlotDirective = ConfirmSlotDirective::create('', $intent);
        $this->assertSame('Dialog.ConfirmSlot', $confirmSlotDirective->type);
    }
}
