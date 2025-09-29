<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Dialog\UpdateDynamicEntities;

use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities\Clear;
use PHPUnit\Framework\TestCase;

class ClearTest extends TestCase
{
    public function testCreate(): void
    {
        /** @var Clear $directive */
        $directive = Clear::create();
        $this->assertSame('Dialog.UpdateDynamicEntities', $directive->type);
        $this->assertSame('CLEAR', $directive->updateBehavior);
    }
}
