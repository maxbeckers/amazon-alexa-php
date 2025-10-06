<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\KeyHandler;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class KeyHandlerTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $propagate = true;
        $when = 'event.key == "Enter"';

        $keyHandler = new KeyHandler($commands, $propagate, $when);

        $this->assertSame($commands, $keyHandler->commands);
        $this->assertTrue($keyHandler->propagate);
        $this->assertSame($when, $keyHandler->when);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $keyHandler = new KeyHandler();

        $this->assertSame([], $keyHandler->commands);
        $this->assertFalse($keyHandler->propagate);
        $this->assertNull($keyHandler->when);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $commands = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $propagate = true;
        $when = 'event.type == "KeyDown"';

        $keyHandler = new KeyHandler($commands, $propagate, $when);
        $result = $keyHandler->jsonSerialize();

        $this->assertSame($commands, $result['commands']);
        $this->assertTrue($result['propagate']);
        $this->assertSame($when, $result['when']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $keyHandler = new KeyHandler();
        $result = $keyHandler->jsonSerialize();

        $this->assertSame([], $result['commands']);
        $this->assertFalse($result['propagate']);
        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeWithEmptyCommands(): void
    {
        $keyHandler = new KeyHandler([], true, 'condition');
        $result = $keyHandler->jsonSerialize();

        $this->assertSame([], $result['commands']);
        $this->assertTrue($result['propagate']);
        $this->assertSame('condition', $result['when']);
    }

    public function testJsonSerializeWithNonEmptyCommands(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $keyHandler = new KeyHandler($commands);
        $result = $keyHandler->jsonSerialize();

        $this->assertSame($commands, $result['commands']);
        $this->assertFalse($result['propagate']);
        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeWithPropagateFalse(): void
    {
        $keyHandler = new KeyHandler([], false);
        $result = $keyHandler->jsonSerialize();

        $this->assertFalse($result['propagate']);
    }

    public function testJsonSerializeWithPropagateTrue(): void
    {
        $keyHandler = new KeyHandler([], true);
        $result = $keyHandler->jsonSerialize();

        $this->assertTrue($result['propagate']);
    }

    public function testJsonSerializeFiltersNullWhen(): void
    {
        $keyHandler = new KeyHandler([], false, null);
        $result = $keyHandler->jsonSerialize();

        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeWithEmptyStringWhen(): void
    {
        $keyHandler = new KeyHandler([], false, '');
        $result = $keyHandler->jsonSerialize();

        $this->assertArrayHasKey('when', $result);
        $this->assertSame('', $result['when']);
    }

    public function testJsonSerializeWithValidWhenExpression(): void
    {
        $when = 'event.key == "Escape"';
        $keyHandler = new KeyHandler([], false, $when);
        $result = $keyHandler->jsonSerialize();

        $this->assertArrayHasKey('when', $result);
        $this->assertSame($when, $result['when']);
    }

    public function testJsonSerializeStructure(): void
    {
        $commands = [$this->createMock(AbstractStandardCommand::class)];
        $keyHandler = new KeyHandler($commands, true, 'condition');
        $result = $keyHandler->jsonSerialize();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('commands', $result);
        $this->assertArrayHasKey('propagate', $result);
        $this->assertArrayHasKey('when', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $keyHandler = new KeyHandler();

        $this->assertInstanceOf(\JsonSerializable::class, $keyHandler);
    }
}
