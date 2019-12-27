<?php

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Dialog\Entity;

use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity\Type;
use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity\TypeValue;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    public function testCreate()
    {
        $type = Type::create('AirportSlotType', [
            TypeValue::create('BOS', 'Logan International Airport', ['Boston Logan']),
            TypeValue::create('LGA', 'LaGuardia Airport', ['New York']),
        ]);

        $json     = \file_get_contents(__DIR__.'/../../../../Response/Data/directive_entity_type.json');
        $expected = \json_encode(\json_decode($json));
        $actual   = \json_encode($type);

        $this->assertSame($expected, $actual);
    }
}
