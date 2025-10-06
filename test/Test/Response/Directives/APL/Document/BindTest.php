<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Bind;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\BindType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class BindTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $name = 'testBinding';
        $value = 'testValue';
        $type = BindType::STRING;
        $onChange = [$this->createMock(AbstractStandardCommand::class)];

        $bind = new Bind($name, $value, $type, $onChange);

        $this->assertSame($name, $bind->name);
        $this->assertSame($value, $bind->value);
        $this->assertSame($type, $bind->type);
        $this->assertSame($onChange, $bind->onChange);
    }

    public function testConstructorWithDefaultType(): void
    {
        $name = 'myBinding';
        $value = 42;

        $bind = new Bind($name, $value);

        $this->assertSame($name, $bind->name);
        $this->assertSame($value, $bind->value);
        $this->assertSame(BindType::ANY, $bind->type);
        $this->assertEmpty($bind->onChange);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $name = 'binding1';
        $value = ['array', 'value'];
        $type = BindType::BOOLEAN;
        $onChange = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];

        $bind = new Bind($name, $value, $type, $onChange);
        $result = $bind->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertSame($value, $result['value']);
        $this->assertSame($type->value, $result['type']);
        $this->assertSame($onChange, $result['onChange']);
    }

    public function testJsonSerializeWithEmptyOnChange(): void
    {
        $bind = new Bind('test', 'value', BindType::NUMBER, []);
        $result = $bind->jsonSerialize();

        $this->assertArrayNotHasKey('onChange', $result);
    }

    public function testJsonSerializeWithDifferentValueTypes(): void
    {
        $testCases = [
            ['string value', BindType::STRING],
            [123, BindType::NUMBER],
            [45.67, BindType::NUMBER],
            [true, BindType::BOOLEAN],
            [['nested' => 'array'], BindType::ANY],
            [null, BindType::ANY],
        ];

        foreach ($testCases as [$value, $type]) {
            $bind = new Bind('test', $value, $type);
            $result = $bind->jsonSerialize();

            $this->assertSame($value, $result['value']);
            $this->assertSame($type->value, $result['type']);
        }
    }

    public function testJsonSerializeWithDifferentBindTypes(): void
    {
        $bindTypes = [BindType::ANY, BindType::STRING, BindType::NUMBER, BindType::BOOLEAN];

        foreach ($bindTypes as $type) {
            $bind = new Bind('test', 'value', $type);
            $result = $bind->jsonSerialize();

            $this->assertSame($type->value, $result['type']);
        }
    }

    public function testImplementsJsonSerializable(): void
    {
        $bind = new Bind('test', 'value');

        $this->assertInstanceOf(\JsonSerializable::class, $bind);
    }
}
