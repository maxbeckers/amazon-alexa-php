<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Parameter;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ParameterType;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $name = 'testParameter';
        $default = 'defaultValue';
        $description = 'Test parameter description';
        $type = ParameterType::STRING;

        $parameter = new Parameter($name, $default, $description, $type);

        $this->assertSame($name, $parameter->name);
        $this->assertSame($default, $parameter->default);
        $this->assertSame($description, $parameter->description);
        $this->assertSame($type, $parameter->type);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $name = 'myParameter';

        $parameter = new Parameter($name);

        $this->assertSame($name, $parameter->name);
        $this->assertNull($parameter->default);
        $this->assertNull($parameter->description);
        $this->assertNull($parameter->type);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $name = 'fullParameter';
        $default = 42;
        $description = 'Numeric parameter';
        $type = ParameterType::NUMBER;

        $parameter = new Parameter($name, $default, $description, $type);
        $result = $parameter->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertSame($type, $result['type']);
        $this->assertSame($default, $result['default']);
        $this->assertSame($description, $result['description']);
    }

    public function testJsonSerializeWithMinimalProperties(): void
    {
        $name = 'minimalParameter';

        $parameter = new Parameter($name);
        $result = $parameter->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertArrayNotHasKey('type', $result);
        $this->assertArrayNotHasKey('default', $result);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithNullType(): void
    {
        $parameter = new Parameter('test', 'value', 'description', null);
        $result = $parameter->jsonSerialize();

        $this->assertSame('test', $result['name']);
        $this->assertSame('value', $result['default']);
        $this->assertSame('description', $result['description']);
        $this->assertArrayNotHasKey('type', $result);
    }

    public function testJsonSerializeWithNullDefault(): void
    {
        $parameter = new Parameter('test', null, 'description', ParameterType::BOOLEAN);
        $result = $parameter->jsonSerialize();

        $this->assertSame('test', $result['name']);
        $this->assertSame(ParameterType::BOOLEAN, $result['type']);
        $this->assertSame('description', $result['description']);
        $this->assertArrayNotHasKey('default', $result);
    }

    public function testJsonSerializeWithNullDescription(): void
    {
        $parameter = new Parameter('test', 'value', null, ParameterType::STRING);
        $result = $parameter->jsonSerialize();

        $this->assertSame('test', $result['name']);
        $this->assertSame(ParameterType::STRING, $result['type']);
        $this->assertSame('value', $result['default']);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithDifferentDefaultTypes(): void
    {
        $testCases = [
            ['string value', ParameterType::STRING],
            [123, ParameterType::NUMBER],
            [45.67, ParameterType::NUMBER],
            [true, ParameterType::BOOLEAN],
            [['array', 'value'], ParameterType::ANY],
        ];

        foreach ($testCases as [$default, $type]) {
            $parameter = new Parameter('test', $default, null, $type);
            $result = $parameter->jsonSerialize();

            $this->assertSame($default, $result['default']);
            $this->assertSame($type, $result['type']);
        }
    }

    public function testJsonSerializeWithDifferentParameterTypes(): void
    {
        $types = [
            ParameterType::ANY,
            ParameterType::STRING,
            ParameterType::NUMBER,
            ParameterType::BOOLEAN,
        ];

        foreach ($types as $type) {
            $parameter = new Parameter('test', null, null, $type);
            $result = $parameter->jsonSerialize();

            $this->assertSame($type, $result['type']);
        }
    }

    public function testJsonSerializeWithZeroDefault(): void
    {
        $parameter = new Parameter('test', 0);
        $result = $parameter->jsonSerialize();

        $this->assertArrayHasKey('default', $result);
        $this->assertSame(0, $result['default']);
    }

    public function testJsonSerializeWithFalseDefault(): void
    {
        $parameter = new Parameter('test', false);
        $result = $parameter->jsonSerialize();

        $this->assertArrayHasKey('default', $result);
        $this->assertFalse($result['default']);
    }

    public function testJsonSerializeWithEmptyStringDefault(): void
    {
        $parameter = new Parameter('test', '');
        $result = $parameter->jsonSerialize();

        $this->assertArrayHasKey('default', $result);
        $this->assertSame('', $result['default']);
    }

    public function testJsonSerializePropertyOrder(): void
    {
        $parameter = new Parameter('test', 'value', 'description', ParameterType::STRING);
        $result = $parameter->jsonSerialize();

        $keys = array_keys($result);
        $this->assertSame('name', $keys[0]);
        $this->assertSame('type', $keys[1]);
        $this->assertSame('default', $keys[2]);
        $this->assertSame('description', $keys[3]);
    }

    public function testImplementsJsonSerializable(): void
    {
        $parameter = new Parameter('test');

        $this->assertInstanceOf(\JsonSerializable::class, $parameter);
    }
}
