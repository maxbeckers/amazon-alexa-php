<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ControlMediaCommand as ControlMediaCommandType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\ControlMediaCommand;
use PHPUnit\Framework\TestCase;

class ControlMediaCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $command = ControlMediaCommandType::PLAY;
        $componentId = 'myVideo';
        $value = 1000;

        $controlMediaCommand = new ControlMediaCommand($command, $componentId, $value);

        $this->assertSame($command, $controlMediaCommand->command);
        $this->assertSame($componentId, $controlMediaCommand->componentId);
        $this->assertSame($value, $controlMediaCommand->value);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new ControlMediaCommand();

        $this->assertNull($command->command);
        $this->assertNull($command->componentId);
        $this->assertNull($command->value);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $commandType = ControlMediaCommandType::PAUSE;
        $componentId = 'testVideo';
        $value = 2000;

        $command = new ControlMediaCommand($commandType, $componentId, $value);
        $result = $command->jsonSerialize();

        $this->assertSame(ControlMediaCommand::TYPE, $result['type']);
        $this->assertSame($commandType->value, $result['command']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($value, $result['value']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new ControlMediaCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(ControlMediaCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('command', $result);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('value', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = new ControlMediaCommand(ControlMediaCommandType::PLAY, 'video1');
        $result = $command->jsonSerialize();

        $this->assertSame(ControlMediaCommand::TYPE, $result['type']);
        $this->assertSame(ControlMediaCommandType::PLAY->value, $result['command']);
        $this->assertSame('video1', $result['componentId']);
        $this->assertArrayNotHasKey('value', $result);
    }
}
