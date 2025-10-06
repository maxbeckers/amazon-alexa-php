<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Command;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Parameter;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $parameters = [$this->createMock(Parameter::class)];
        $command = $this->createMock(AbstractStandardCommand::class);
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $description = 'Test command description';

        $commandObj = new Command($parameters, $command, $commands, $description);

        $this->assertSame($parameters, $commandObj->parameters);
        $this->assertSame($command, $commandObj->command);
        $this->assertSame($commands, $commandObj->commands);
        $this->assertSame($description, $commandObj->description);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new Command();

        $this->assertNull($command->parameters);
        $this->assertNull($command->command);
        $this->assertNull($command->commands);
        $this->assertNull($command->description);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $parameters = [
            $this->createMock(Parameter::class),
            $this->createMock(Parameter::class),
        ];
        $command = $this->createMock(AbstractStandardCommand::class);
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $description = 'Complex command';

        $commandObj = new Command($parameters, $command, $commands, $description);
        $result = $commandObj->jsonSerialize();

        $this->assertSame($parameters, $result['parameters']);
        $this->assertSame($command, $result['command']);
        $this->assertSame($commands, $result['commands']);
        $this->assertSame($description, $result['description']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new Command();
        $result = $command->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('command', $result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = $this->createMock(AbstractStandardCommand::class);
        $description = 'Partial command';

        $commandObj = new Command(null, $command, null, $description);
        $result = $commandObj->jsonSerialize();

        $this->assertSame($command, $result['command']);
        $this->assertSame($description, $result['description']);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('commands', $result);
    }

    public function testJsonSerializeWithOnlyParameters(): void
    {
        $parameters = [$this->createMock(Parameter::class)];

        $command = new Command($parameters);
        $result = $command->jsonSerialize();

        $this->assertSame($parameters, $result['parameters']);
        $this->assertArrayNotHasKey('command', $result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithOnlyCommands(): void
    {
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];

        $command = new Command(null, null, $commands);
        $result = $command->jsonSerialize();

        $this->assertSame($commands, $result['commands']);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('command', $result);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithEmptyDescription(): void
    {
        $command = new Command(description: '');
        $result = $command->jsonSerialize();

        $this->assertSame('', $result['description']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $command = new Command();

        $this->assertInstanceOf(\JsonSerializable::class, $command);
    }
}
