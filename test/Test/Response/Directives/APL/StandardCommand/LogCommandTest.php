<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LogLevel;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\LogCommand;
use PHPUnit\Framework\TestCase;

class LogCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $level = LogLevel::ERROR;
        $message = 'Test error message';
        $arguments = ['key1' => 'value1', 'key2' => 'value2'];

        $command = new LogCommand($level, $message, $arguments);

        $this->assertSame($level, $command->level);
        $this->assertSame($message, $command->message);
        $this->assertSame($arguments, $command->arguments);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new LogCommand();

        $this->assertSame(LogLevel::INFO, $command->level);
        $this->assertNull($command->message);
        $this->assertNull($command->arguments);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $level = LogLevel::WARN;
        $message = 'Warning message';
        $arguments = ['userId' => '123', 'action' => 'test'];

        $command = new LogCommand($level, $message, $arguments);
        $result = $command->jsonSerialize();

        $this->assertSame(LogCommand::TYPE, $result['type']);
        $this->assertSame($level->value, $result['level']);
        $this->assertSame($message, $result['message']);
        $this->assertSame($arguments, $result['arguments']);
    }

    public function testJsonSerializeWithDefaultLevel(): void
    {
        $command = new LogCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(LogCommand::TYPE, $result['type']);
        $this->assertSame(LogLevel::INFO->value, $result['level']);
        $this->assertArrayNotHasKey('message', $result);
        $this->assertArrayNotHasKey('arguments', $result);
    }

    public function testJsonSerializeWithEmptyArguments(): void
    {
        $command = new LogCommand(LogLevel::DEBUG, 'Debug message', []);
        $result = $command->jsonSerialize();

        $this->assertSame(LogLevel::DEBUG->value, $result['level']);
        $this->assertSame('Debug message', $result['message']);
        $this->assertArrayNotHasKey('arguments', $result);
    }

    public function testJsonSerializeWithDifferentLogLevels(): void
    {
        $levels = [LogLevel::DEBUG, LogLevel::INFO, LogLevel::WARN, LogLevel::ERROR];

        foreach ($levels as $level) {
            $command = new LogCommand($level, 'Test message');
            $result = $command->jsonSerialize();

            $this->assertSame($level->value, $result['level']);
        }
    }
}
