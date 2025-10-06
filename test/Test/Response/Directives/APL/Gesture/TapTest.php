<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture\Tap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class TapTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $onTap = [$this->createMock(AbstractStandardCommand::class)];
        $onCancel = [$this->createMock(AbstractStandardCommand::class)];
        $when = true;

        $gesture = new Tap($onTap, $onCancel, $when);

        $this->assertSame($onTap, $gesture->onTap);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $gesture = new Tap();

        $this->assertNull($gesture->onTap);
    }

    public function testJsonSerializeWithOnTapCommand(): void
    {
        $onTap = [$this->createMock(AbstractStandardCommand::class)];
        $onCancel = [$this->createMock(AbstractStandardCommand::class)];

        $gesture = new Tap($onTap, $onCancel, false);
        $result = $gesture->jsonSerialize();

        $this->assertSame(GestureType::TAP->value, $result['type']);
        $this->assertSame($onTap, $result['onTap']);
        $this->assertSame($onCancel, $result['onCancel']);
        $this->assertFalse($result['when']);
    }

    public function testJsonSerializeWithEmptyArray(): void
    {
        $gesture = new Tap([]);
        $result = $gesture->jsonSerialize();

        $this->assertArrayNotHasKey('onTap', $result);
    }

    public function testJsonSerializeWithNullValue(): void
    {
        $gesture = new Tap();
        $result = $gesture->jsonSerialize();

        $this->assertSame(GestureType::TAP->value, $result['type']);
        $this->assertArrayNotHasKey('onTap', $result);
    }
}
