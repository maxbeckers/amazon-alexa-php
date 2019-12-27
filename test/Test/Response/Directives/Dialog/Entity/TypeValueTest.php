<?php

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Dialog\Entity;

use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity\TypeValue;
use PHPUnit\Framework\TestCase;

class TypeValueTest extends TestCase
{
    public function testCreate()
    {
        $typeValue = TypeValue::create('BOS', 'Logan International Airport', ['Boston Logan']);

        $json     = \file_get_contents(__DIR__.'/../../../../Response/Data/directive_entity_type_value.json');
        $expected = \json_encode(\json_decode($json));
        $actual   = \json_encode($typeValue);

        $this->assertSame($expected, $actual);
    }
}
