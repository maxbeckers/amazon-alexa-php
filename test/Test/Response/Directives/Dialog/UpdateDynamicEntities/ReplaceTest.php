<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Dialog\UpdateDynamicEntities;

use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity\Type;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity\TypeValue;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities\Replace;
use PHPUnit\Framework\TestCase;

class ReplaceTest extends TestCase
{
    public function testCreateWithReplaceBehaviour(): void
    {
        $type = Type::create('AirportSlotType', [
            TypeValue::create('LGA', 'LaGuardia Airport', ['New York']),
        ]);

        /** @var Replace $directive */
        $directive = Replace::create();
        $directive->addType($type);
        $this->assertIsArray($directive->types);
        $this->assertSame([$type], $directive->types);
        $this->assertSame('Dialog.UpdateDynamicEntities', $directive->type);
        $this->assertSame('REPLACE', $directive->updateBehavior);

        $json = \file_get_contents(__DIR__ . '/../../../../Response/Data/directive_dialog_update_dynamic_entities_replace.json');
        $expected = \json_decode($json);

        $this->assertSame($expected->type, $directive->type);
        $this->assertSame($expected->updateBehavior, $directive->updateBehavior);
        $this->assertSame(\count($expected->types), \count($directive->types));
        $this->assertSame(\json_encode($expected->types), \json_encode($directive->types));
    }
}
