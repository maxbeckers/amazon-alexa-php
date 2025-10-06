<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TickHandler;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class TickHandlerTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $when = 'condition';
        $description = 'Test handler';
        $minimumDelay = 2000;

        $handler = new TickHandler($commands, $when, $description, $minimumDelay);

        $this->assertSame($commands, $handler->commands);
        $this->assertSame($when, $handler->when);
        $this->assertSame($description, $handler->description);
        $this->assertSame($minimumDelay, $handler->minimumDelay);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $handler = new TickHandler();

        $this->assertSame([], $handler->commands);
        $this->assertNull($handler->when);
        $this->assertSame('', $handler->description);
        $this->assertSame(TickHandler::DEFAULT_MINIMUM_DELAY, $handler->minimumDelay);
    }

    public function testConstructorFiltersInvalidCommands(): void
    {
        $validCommand = $this->createMock(AbstractStandardCommand::class);
        $invalidCommands = [
            $validCommand,
            'not a command',
            null,
            123,
            $this->createMock(AbstractStandardCommand::class),
        ];

        $handler = new TickHandler($invalidCommands);

        $this->assertCount(2, $handler->commands);
        $this->assertContains($validCommand, $handler->commands);
        $this->assertIsArray($handler->commands);
        $this->assertContainsOnlyInstancesOf(AbstractStandardCommand::class, $handler->commands);
    }

    public function testConstructorReindexesArray(): void
    {
        $command1 = $this->createMock(AbstractStandardCommand::class);
        $command2 = $this->createMock(AbstractStandardCommand::class);
        $commands = [
            0 => $command1,
            2 => 'invalid',
            5 => $command2,
        ];

        $handler = new TickHandler($commands);

        $this->assertSame([0 => $command1, 1 => $command2], $handler->commands);
    }

    public function testDefaultMinimumDelayConstant(): void
    {
        $this->assertSame(1000, TickHandler::DEFAULT_MINIMUM_DELAY);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $when = 'active';
        $description = 'Full handler';
        $minimumDelay = 3000;

        $handler = new TickHandler($commands, $when, $description, $minimumDelay);
        $result = $handler->jsonSerialize();

        $this->assertSame($commands, $result['commands']);
        $this->assertSame($description, $result['description']);
        $this->assertSame($minimumDelay, $result['minimumDelay']);
        $this->assertSame($when, $result['when']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $handler = new TickHandler();
        $result = $handler->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('minimumDelay', $result);
        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeFiltersEmptyCommands(): void
    {
        $handler = new TickHandler([], 'condition', 'test', 500);
        $result = $handler->jsonSerialize();

        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayHasKey('when', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('minimumDelay', $result);
    }

    public function testJsonSerializeFiltersEmptyDescription(): void
    {
        $handler = new TickHandler([], null, '', 2000);
        $result = $handler->jsonSerialize();

        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayHasKey('minimumDelay', $result);
    }

    public function testJsonSerializeFiltersDefaultMinimumDelay(): void
    {
        $handler = new TickHandler([], 'when', 'desc', TickHandler::DEFAULT_MINIMUM_DELAY);
        $result = $handler->jsonSerialize();

        $this->assertArrayNotHasKey('minimumDelay', $result);
        $this->assertArrayHasKey('when', $result);
        $this->assertArrayHasKey('description', $result);
    }

    public function testJsonSerializeFiltersNullWhen(): void
    {
        $handler = new TickHandler([], null, 'desc', 500);
        $result = $handler->jsonSerialize();

        $this->assertArrayNotHasKey('when', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('minimumDelay', $result);
    }

    public function testJsonSerializeFiltersEmptyWhen(): void
    {
        $handler = new TickHandler([], '', 'desc', 500);
        $result = $handler->jsonSerialize();

        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeWithNonEmptyCommands(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $handler = new TickHandler($commands);
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('commands', $result);
        $this->assertSame($commands, $result['commands']);
    }

    public function testJsonSerializeWithNonEmptyDescription(): void
    {
        $handler = new TickHandler([], null, 'Test description');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('description', $result);
        $this->assertSame('Test description', $result['description']);
    }

    public function testJsonSerializeWithNonDefaultMinimumDelay(): void
    {
        $handler = new TickHandler([], null, '', 5000);
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('minimumDelay', $result);
        $this->assertSame(5000, $result['minimumDelay']);
    }

    public function testJsonSerializeWithNonEmptyWhen(): void
    {
        $handler = new TickHandler([], 'viewport.width > 100');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('when', $result);
        $this->assertSame('viewport.width > 100', $result['when']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $handler = new TickHandler();

        $this->assertInstanceOf(\JsonSerializable::class, $handler);
    }
}
