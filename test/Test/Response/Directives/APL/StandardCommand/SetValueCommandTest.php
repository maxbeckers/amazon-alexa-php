<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SetValueCommand;
use PHPUnit\Framework\TestCase;

class SetValueCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myComponent';
        $property = 'text';
        $value = 'Hello World';

        $command = new SetValueCommand($componentId, $property, $value);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($property, $command->property);
        $this->assertSame($value, $command->value);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new SetValueCommand();

        $this->assertNull($command->componentId);
        $this->assertNull($command->property);
        $this->assertNull($command->value);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testComponent';
        $property = 'opacity';
        $value = 0.5;

        $command = new SetValueCommand($componentId, $property, $value);
        $result = $command->jsonSerialize();

        $this->assertSame(SetValueCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($property, $result['property']);
        $this->assertSame($value, $result['value']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new SetValueCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(SetValueCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('property', $result);
        $this->assertArrayNotHasKey('value', $result);
    }

    public function testJsonSerializeWithDifferentValueTypes(): void
    {
        $testCases = [
            ['string value', 'string'],
            [123, 'integer'],
            [45.67, 'float'],
            [true, 'boolean'],
            [['nested' => 'array'], 'array'],
        ];

        foreach ($testCases as [$value, $description]) {
            $command = new SetValueCommand('comp', 'prop', $value);
            $result = $command->jsonSerialize();

            $this->assertSame($value, $result['value'], "Failed for $description");
        }
    }

    public function testJsonSerializeWithZeroValue(): void
    {
        $command = new SetValueCommand('component', 'property', 0);
        $result = $command->jsonSerialize();

        $this->assertSame(SetValueCommand::TYPE, $result['type']);
        $this->assertSame('component', $result['componentId']);
        $this->assertSame('property', $result['property']);
        $this->assertSame(0, $result['value']);
    }

    public function testJsonSerializeWithFalseValue(): void
    {
        $command = new SetValueCommand('component', 'visible', false);
        $result = $command->jsonSerialize();

        $this->assertFalse($result['value']);
    }

    public function testJsonSerializeWithEmptyStringValue(): void
    {
        $command = new SetValueCommand('component', 'text', '');
        $result = $command->jsonSerialize();

        $this->assertSame('', $result['value']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('SetValue', SetValueCommand::TYPE);
    }
}
