<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SequentialCommand;
use PHPUnit\Framework\TestCase;

class SequentialCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $catch = [$this->createMock(AbstractStandardCommand::class)];
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $data = ['item1', 'item2'];
        $repeatCount = 3;
        $finally = [$this->createMock(AbstractStandardCommand::class)];

        $command = new SequentialCommand($catch, $commands, $data, $repeatCount, $finally);

        $this->assertSame($catch, $command->catch);
        $this->assertSame($commands, $command->commands);
        $this->assertSame($data, $command->data);
        $this->assertSame($repeatCount, $command->repeatCount);
        $this->assertSame($finally, $command->finally);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new SequentialCommand();

        $this->assertNull($command->catch);
        $this->assertNull($command->commands);
        $this->assertNull($command->data);
        $this->assertNull($command->repeatCount);
        $this->assertNull($command->finally);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $catch = [$this->createMock(AbstractStandardCommand::class)];
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $data = ['value1', 'value2'];
        $repeatCount = 2;
        $finally = [$this->createMock(AbstractStandardCommand::class)];

        $command = new SequentialCommand($catch, $commands, $data, $repeatCount, $finally);
        $result = $command->jsonSerialize();

        $this->assertSame(SequentialCommand::TYPE, $result['type']);
        $this->assertSame($catch, $result['catch']);
        $this->assertSame($commands, $result['commands']);
        $this->assertSame($data, $result['data']);
        $this->assertSame($repeatCount, $result['repeatCount']);
        $this->assertSame($finally, $result['finally']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $command = new SequentialCommand([], [], [], null, []);
        $result = $command->jsonSerialize();

        $this->assertSame(SequentialCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('catch', $result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('finally', $result);
        $this->assertArrayNotHasKey('repeatCount', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new SequentialCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(SequentialCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('catch', $result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('repeatCount', $result);
        $this->assertArrayNotHasKey('finally', $result);
    }

    public function testJsonSerializeWithZeroRepeatCount(): void
    {
        $command = new SequentialCommand(null, null, null, 0);
        $result = $command->jsonSerialize();

        $this->assertSame(SequentialCommand::TYPE, $result['type']);
        $this->assertSame(0, $result['repeatCount']);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $command = new SequentialCommand(null, $commands, null, 1);
        $result = $command->jsonSerialize();

        $this->assertSame(SequentialCommand::TYPE, $result['type']);
        $this->assertSame($commands, $result['commands']);
        $this->assertSame(1, $result['repeatCount']);
        $this->assertArrayNotHasKey('catch', $result);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('finally', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('Sequential', SequentialCommand::TYPE);
    }
}
