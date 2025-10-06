<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Action;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class ActionTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $command = $this->createMock(AbstractStandardCommand::class);
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $enabled = false;
        $label = 'Test Action';
        $name = 'testAction';

        $action = new Action($command, $commands, $enabled, $label, $name);

        $this->assertSame($command, $action->command);
        $this->assertSame($commands, $action->commands);
        $this->assertSame($enabled, $action->enabled);
        $this->assertSame($label, $action->label);
        $this->assertSame($name, $action->name);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $action = new Action();

        $this->assertNull($action->command);
        $this->assertNull($action->commands);
        $this->assertTrue($action->enabled);
        $this->assertNull($action->label);
        $this->assertNull($action->name);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $command = $this->createMock(AbstractStandardCommand::class);
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $label = 'My Action';
        $name = 'myAction';

        $action = new Action($command, $commands, false, $label, $name);
        $result = $action->jsonSerialize();

        $this->assertSame($command, $result['command']);
        $this->assertSame($commands, $result['commands']);
        $this->assertFalse($result['enabled']);
        $this->assertSame($label, $result['label']);
        $this->assertSame($name, $result['name']);
    }

    public function testJsonSerializeWithDefaultEnabled(): void
    {
        $action = new Action();
        $result = $action->jsonSerialize();

        $this->assertArrayNotHasKey('enabled', $result);
    }

    public function testJsonSerializeWithDisabledAction(): void
    {
        $action = new Action(enabled: false);
        $result = $action->jsonSerialize();

        $this->assertFalse($result['enabled']);
    }

    public function testJsonSerializeWithEmptyCommands(): void
    {
        $action = new Action(commands: []);
        $result = $action->jsonSerialize();

        $this->assertArrayNotHasKey('commands', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $action = new Action();
        $result = $action->jsonSerialize();

        $this->assertArrayNotHasKey('command', $result);
        $this->assertArrayNotHasKey('commands', $result);
        $this->assertArrayNotHasKey('label', $result);
        $this->assertArrayNotHasKey('name', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $action = new Action();

        $this->assertInstanceOf(\JsonSerializable::class, $action);
    }
}
