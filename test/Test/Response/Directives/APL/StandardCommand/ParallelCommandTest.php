<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\ParallelCommand;
use PHPUnit\Framework\TestCase;

class ParallelCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $data = ['item1', 'item2', 'item3'];
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];

        $command = new ParallelCommand($data, $commands);

        $this->assertSame($data, $command->data);
        $this->assertSame($commands, $command->commands);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new ParallelCommand();

        $this->assertNull($command->data);
        $this->assertNull($command->commands);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $data = ['value1', 'value2'];
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];

        $command = new ParallelCommand($data, $commands);
        $result = $command->jsonSerialize();

        $this->assertSame(ParallelCommand::TYPE, $result['type']);
        $this->assertSame($data, $result['data']);
        $this->assertSame($commands, $result['commands']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $command = new ParallelCommand([], []);
        $result = $command->jsonSerialize();

        $this->assertSame(ParallelCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('commands', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new ParallelCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(ParallelCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('commands', $result);
    }

    public function testJsonSerializeWithDataOnly(): void
    {
        $data = ['test1', 'test2'];
        $command = new ParallelCommand($data);
        $result = $command->jsonSerialize();

        $this->assertSame(ParallelCommand::TYPE, $result['type']);
        $this->assertSame($data, $result['data']);
        $this->assertArrayNotHasKey('commands', $result);
    }

    public function testJsonSerializeWithCommandsOnly(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $command = new ParallelCommand(null, $commands);
        $result = $command->jsonSerialize();

        $this->assertSame(ParallelCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertSame($commands, $result['commands']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('Parallel', ParallelCommand::TYPE);
    }
}
