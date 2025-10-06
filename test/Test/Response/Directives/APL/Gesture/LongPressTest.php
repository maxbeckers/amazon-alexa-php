<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture\LongPress;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class LongPressTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $onLongPressStart = [$this->createMock(AbstractStandardCommand::class)];
        $onLongPressEnd = [$this->createMock(AbstractStandardCommand::class)];
        $onCancel = [$this->createMock(AbstractStandardCommand::class)];
        $when = false;

        $gesture = new LongPress($onLongPressStart, $onLongPressEnd, $onCancel, $when);

        $this->assertSame($onLongPressStart, $gesture->onLongPressStart);
        $this->assertSame($onLongPressEnd, $gesture->onLongPressEnd);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $gesture = new LongPress();

        $this->assertNull($gesture->onLongPressStart);
        $this->assertNull($gesture->onLongPressEnd);
    }

    public function testJsonSerializeWithAllCommands(): void
    {
        $onLongPressStart = [$this->createMock(AbstractStandardCommand::class)];
        $onLongPressEnd = [$this->createMock(AbstractStandardCommand::class)];
        $onCancel = [$this->createMock(AbstractStandardCommand::class)];

        $gesture = new LongPress($onLongPressStart, $onLongPressEnd, $onCancel, false);
        $result = $gesture->jsonSerialize();

        $this->assertSame(GestureType::LONG_PRESS->value, $result['type']);
        $this->assertSame($onLongPressStart, $result['onLongPressStart']);
        $this->assertSame($onLongPressEnd, $result['onLongPressEnd']);
        $this->assertSame($onCancel, $result['onCancel']);
        $this->assertFalse($result['when']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $gesture = new LongPress([], []);
        $result = $gesture->jsonSerialize();

        $this->assertArrayNotHasKey('onLongPressStart', $result);
        $this->assertArrayNotHasKey('onLongPressEnd', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $gesture = new LongPress();
        $result = $gesture->jsonSerialize();

        $this->assertSame(GestureType::LONG_PRESS->value, $result['type']);
        $this->assertArrayNotHasKey('onLongPressStart', $result);
        $this->assertArrayNotHasKey('onLongPressEnd', $result);
    }
}
