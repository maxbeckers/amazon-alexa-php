<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SelectCommand;
use PHPUnit\Framework\TestCase;

class SelectCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myComponent';
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $data = ['item1', 'item2'];
        $otherwise = [$this->createMock(AbstractStandardCommand::class)];

        $command = new SelectCommand($componentId, $commands, $data, $otherwise);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($commands, $command->commands);
        $this->assertSame($data, $command->data);
        $this->assertSame($otherwise, $command->otherwise);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new SelectCommand();

        $this->assertNull($command->componentId);
        $this->assertNull($command->commands);
        $this->assertNull($command->data);
        $this->assertNull($command->otherwise);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testComponent';
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $data = ['value1', 'value2'];
        $otherwise = [$this->createMock(AbstractStandardCommand::class)];

        $command = new SelectCommand($componentId, $commands, $data, $otherwise);
        $result = $command->jsonSerialize();

        $this->assertSame(SelectCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($commands, $result['commands']);
        $this->assertSame($data, $result['data']);
        $this->assertSame($otherwise, $result['otherwise']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $command = new SelectCommand('comp', [], [], []);
        $result = $command->jsonSerialize();

        $this->assertSame(SelectCommand::TYPE, $result['type']);
        $this->assertSame('comp', $result['componentId']);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('otherwise', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new SelectCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(SelectCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('otherwise', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $command = new SelectCommand('select1', $commands);
        $result = $command->jsonSerialize();

        $this->assertSame(SelectCommand::TYPE, $result['type']);
        $this->assertSame('select1', $result['componentId']);
        $this->assertSame($commands, $result['commands']);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('otherwise', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('Select', SelectCommand::TYPE);
    }
}
