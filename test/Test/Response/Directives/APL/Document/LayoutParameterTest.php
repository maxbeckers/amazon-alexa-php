<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutParameter;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutParameterType;
use PHPUnit\Framework\TestCase;

class LayoutParameterTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $name = 'testParameter';
        $default = 'defaultValue';
        $description = 'Test parameter description';
        $type = LayoutParameterType::STRING;

        $parameter = new LayoutParameter($name, $default, $description, $type);

        $this->assertSame($name, $parameter->name);
        $this->assertSame($default, $parameter->default);
        $this->assertSame($description, $parameter->description);
        $this->assertSame($type, $parameter->type);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $name = 'myParameter';

        $parameter = new LayoutParameter($name);

        $this->assertSame($name, $parameter->name);
        $this->assertNull($parameter->default);
        $this->assertNull($parameter->description);
        $this->assertSame(LayoutParameterType::ANY, $parameter->type);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $name = 'fullParameter';
        $default = 42;
        $description = 'Numeric parameter';
        $type = LayoutParameterType::NUMBER;

        $parameter = new LayoutParameter($name, $default, $description, $type);
        $result = $parameter->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertSame($type, $result['type']);
        $this->assertSame($default, $result['default']);
        $this->assertSame($description, $result['description']);
    }

    public function testJsonSerializeWithMinimalProperties(): void
    {
        $name = 'minimalParameter';

        $parameter = new LayoutParameter($name);
        $result = $parameter->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertSame(LayoutParameterType::ANY, $result['type']);
        $this->assertArrayNotHasKey('default', $result);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithNullDefault(): void
    {
        $parameter = new LayoutParameter('test', null, 'description', LayoutParameterType::BOOLEAN);
        $result = $parameter->jsonSerialize();

        $this->assertSame('test', $result['name']);
        $this->assertSame(LayoutParameterType::BOOLEAN, $result['type']);
        $this->assertSame('description', $result['description']);
        $this->assertArrayNotHasKey('default', $result);
    }

    public function testJsonSerializeWithNullDescription(): void
    {
        $parameter = new LayoutParameter('test', 'value', null, LayoutParameterType::STRING);
        $result = $parameter->jsonSerialize();

        $this->assertSame('test', $result['name']);
        $this->assertSame(LayoutParameterType::STRING, $result['type']);
        $this->assertSame('value', $result['default']);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithDifferentDefaultTypes(): void
    {
        $testCases = [
            ['string value', LayoutParameterType::STRING],
            [123, LayoutParameterType::NUMBER],
            [45.67, LayoutParameterType::NUMBER],
            [true, LayoutParameterType::BOOLEAN],
            [['array', 'value'], LayoutParameterType::ANY],
        ];

        foreach ($testCases as [$default, $type]) {
            $parameter = new LayoutParameter('test', $default, null, $type);
            $result = $parameter->jsonSerialize();

            $this->assertSame($default, $result['default']);
            $this->assertSame($type, $result['type']);
        }
    }

    public function testJsonSerializeWithDifferentParameterTypes(): void
    {
        $types = [
            LayoutParameterType::ANY,
            LayoutParameterType::STRING,
            LayoutParameterType::NUMBER,
            LayoutParameterType::BOOLEAN,
        ];

        foreach ($types as $type) {
            $parameter = new LayoutParameter('test', null, null, $type);
            $result = $parameter->jsonSerialize();

            $this->assertSame($type, $result['type']);
        }
    }

    public function testJsonSerializeWithZeroDefault(): void
    {
        $parameter = new LayoutParameter('test', 0);
        $result = $parameter->jsonSerialize();

        $this->assertArrayHasKey('default', $result);
        $this->assertSame(0, $result['default']);
    }

    public function testJsonSerializeWithFalseDefault(): void
    {
        $parameter = new LayoutParameter('test', false);
        $result = $parameter->jsonSerialize();

        $this->assertArrayHasKey('default', $result);
        $this->assertFalse($result['default']);
    }

    public function testJsonSerializeWithEmptyStringDefault(): void
    {
        $parameter = new LayoutParameter('test', '');
        $result = $parameter->jsonSerialize();

        $this->assertArrayHasKey('default', $result);
        $this->assertSame('', $result['default']);
    }

    public function testJsonSerializeStructure(): void
    {
        $parameter = new LayoutParameter('test', 'value', 'description');
        $result = $parameter->jsonSerialize();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('default', $result);
        $this->assertArrayHasKey('description', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $parameter = new LayoutParameter('test');

        $this->assertInstanceOf(\JsonSerializable::class, $parameter);
    }
}
