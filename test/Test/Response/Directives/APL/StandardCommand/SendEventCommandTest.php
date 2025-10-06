<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SendEventCommand;
use PHPUnit\Framework\TestCase;

class SendEventCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $arguments = ['arg1' => 'value1', 'arg2' => 'value2'];
        $components = ['component1', 'component2'];
        $flags = ['interactionMode' => 'standard'];

        $command = new SendEventCommand($arguments, $components, $flags);

        $this->assertSame($arguments, $command->arguments);
        $this->assertSame($components, $command->components);
        $this->assertSame($flags, $command->flags);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new SendEventCommand();

        $this->assertNull($command->arguments);
        $this->assertNull($command->components);
        $this->assertNull($command->flags);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $arguments = ['userId' => '123', 'eventType' => 'click'];
        $components = ['button1', 'panel2'];
        $flags = ['mode' => 'interactive'];

        $command = new SendEventCommand($arguments, $components, $flags);
        $result = $command->jsonSerialize();

        $this->assertSame(SendEventCommand::TYPE, $result['type']);
        $this->assertSame($arguments, $result['arguments']);
        $this->assertSame($components, $result['components']);
        $this->assertSame($flags, $result['flags']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $command = new SendEventCommand([], [], []);
        $result = $command->jsonSerialize();

        $this->assertSame(SendEventCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('arguments', $result);
        $this->assertArrayNotHasKey('components', $result);
        $this->assertArrayNotHasKey('flags', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new SendEventCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(SendEventCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('arguments', $result);
        $this->assertArrayNotHasKey('components', $result);
        $this->assertArrayNotHasKey('flags', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $arguments = ['action' => 'submit'];
        $command = new SendEventCommand($arguments);
        $result = $command->jsonSerialize();

        $this->assertSame(SendEventCommand::TYPE, $result['type']);
        $this->assertSame($arguments, $result['arguments']);
        $this->assertArrayNotHasKey('components', $result);
        $this->assertArrayNotHasKey('flags', $result);
    }

    public function testJsonSerializeWithMixedArrayTypes(): void
    {
        $arguments = ['string', 123, ['nested' => 'array']];
        $components = [1, 'component', ['type' => 'button']];
        $flags = ['flag1', 'flag2' => true];

        $command = new SendEventCommand($arguments, $components, $flags);
        $result = $command->jsonSerialize();

        $this->assertSame($arguments, $result['arguments']);
        $this->assertSame($components, $result['components']);
        $this->assertSame($flags, $result['flags']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('SendEvent', SendEventCommand::TYPE);
    }
}
