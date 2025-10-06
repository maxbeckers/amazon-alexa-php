<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture\DoublePress;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class DoublePressTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $onDoublePress = [$this->createMock(AbstractStandardCommand::class)];
        $onSinglePress = [$this->createMock(AbstractStandardCommand::class)];
        $onCancel = [$this->createMock(AbstractStandardCommand::class)];
        $when = true;

        $gesture = new DoublePress($onDoublePress, $onSinglePress, $onCancel, $when);

        $this->assertSame($onDoublePress, $gesture->onDoublePress);
        $this->assertSame($onSinglePress, $gesture->onSinglePress);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $gesture = new DoublePress();

        $this->assertNull($gesture->onDoublePress);
        $this->assertNull($gesture->onSinglePress);
    }

    public function testJsonSerializeWithAllCommands(): void
    {
        $onDoublePress = [$this->createMock(AbstractStandardCommand::class)];
        $onSinglePress = [$this->createMock(AbstractStandardCommand::class)];
        $onCancel = [$this->createMock(AbstractStandardCommand::class)];

        $gesture = new DoublePress($onDoublePress, $onSinglePress, $onCancel, true);
        $result = $gesture->jsonSerialize();

        $this->assertSame(GestureType::DOUBLE_PRESS->value, $result['type']);
        $this->assertSame($onDoublePress, $result['onDoublePress']);
        $this->assertSame($onSinglePress, $result['onSinglePress']);
        $this->assertSame($onCancel, $result['onCancel']);
        $this->assertTrue($result['when']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $gesture = new DoublePress([], []);
        $result = $gesture->jsonSerialize();

        $this->assertArrayNotHasKey('onDoublePress', $result);
        $this->assertArrayNotHasKey('onSinglePress', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $gesture = new DoublePress();
        $result = $gesture->jsonSerialize();

        $this->assertSame(GestureType::DOUBLE_PRESS->value, $result['type']);
        $this->assertArrayNotHasKey('onDoublePress', $result);
        $this->assertArrayNotHasKey('onSinglePress', $result);
    }
}
