<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\VisibilityChangeHandler;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class VisibilityChangeHandlerTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $when = 'viewport.width > 100';
        $description = 'Test visibility handler';

        $handler = new VisibilityChangeHandler($commands, $when, $description);

        $this->assertSame($commands, $handler->commands);
        $this->assertSame($when, $handler->when);
        $this->assertSame($description, $handler->description);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $handler = new VisibilityChangeHandler();

        $this->assertSame([], $handler->commands);
        $this->assertNull($handler->when);
        $this->assertNull($handler->description);
    }

    public function testConstructorFiltersInvalidCommands(): void
    {
        $validCommand1 = $this->createMock(AbstractStandardCommand::class);
        $validCommand2 = $this->createMock(AbstractStandardCommand::class);
        $invalidCommands = [
            $validCommand1,
            'not a command',
            null,
            123,
            $validCommand2,
            false,
            [],
        ];

        $handler = new VisibilityChangeHandler($invalidCommands);

        $this->assertCount(2, $handler->commands);
        $this->assertSame($validCommand1, $handler->commands[0]);
        $this->assertSame($validCommand2, $handler->commands[1]);
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
            7 => null,
        ];

        $handler = new VisibilityChangeHandler($commands);

        $this->assertSame([0 => $command1, 1 => $command2], $handler->commands);
        $this->assertArrayHasKey(0, $handler->commands);
        $this->assertArrayHasKey(1, $handler->commands);
        $this->assertArrayNotHasKey(2, $handler->commands);
    }

    public function testConstructorWithEmptyCommands(): void
    {
        $handler = new VisibilityChangeHandler([]);

        $this->assertSame([], $handler->commands);
    }

    public function testConstructorWithOnlyInvalidCommands(): void
    {
        $handler = new VisibilityChangeHandler(['string', 123, null, false]);

        $this->assertSame([], $handler->commands);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $when = 'element.visible';
        $description = 'Visibility change handler';

        $handler = new VisibilityChangeHandler($commands, $when, $description);
        $result = $handler->jsonSerialize();

        $this->assertSame($commands, $result['commands']);
        $this->assertSame($description, $result['description']);
        $this->assertSame($when, $result['when']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $handler = new VisibilityChangeHandler();
        $result = $handler->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeFiltersEmptyCommands(): void
    {
        $handler = new VisibilityChangeHandler([], 'condition', 'test');
        $result = $handler->jsonSerialize();

        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('when', $result);
    }

    public function testJsonSerializeFiltersNullDescription(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $handler = new VisibilityChangeHandler($commands, 'when', null);
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('commands', $result);
        $this->assertArrayHasKey('when', $result);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeFiltersEmptyDescription(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $handler = new VisibilityChangeHandler($commands, 'when', '');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('commands', $result);
        $this->assertArrayHasKey('when', $result);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeFiltersNullWhen(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $handler = new VisibilityChangeHandler($commands, null, 'description');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('commands', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeFiltersEmptyWhen(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $handler = new VisibilityChangeHandler($commands, '', 'description');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('commands', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeWithOnlyCommands(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $handler = new VisibilityChangeHandler($commands);
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('commands', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('when', $result);
        $this->assertSame($commands, $result['commands']);
    }

    public function testJsonSerializeWithOnlyDescription(): void
    {
        $handler = new VisibilityChangeHandler([], null, 'Test description');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('description', $result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('when', $result);
        $this->assertSame('Test description', $result['description']);
    }

    public function testJsonSerializeWithOnlyWhen(): void
    {
        $handler = new VisibilityChangeHandler([], 'visibility.changed');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('when', $result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertSame('visibility.changed', $result['when']);
    }

    public function testJsonSerializeWithWhitespaceDescription(): void
    {
        $handler = new VisibilityChangeHandler([], null, '   ');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('description', $result);
        $this->assertSame('   ', $result['description']);
    }

    public function testJsonSerializeWithWhitespaceWhen(): void
    {
        $handler = new VisibilityChangeHandler([], '   ');
        $result = $handler->jsonSerialize();

        $this->assertArrayHasKey('when', $result);
        $this->assertSame('   ', $result['when']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $handler = new VisibilityChangeHandler();

        $this->assertInstanceOf(\JsonSerializable::class, $handler);
    }
}
