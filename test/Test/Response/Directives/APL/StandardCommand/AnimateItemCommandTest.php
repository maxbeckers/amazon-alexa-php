<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\RepeatMode;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Value;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AnimateItemCommand;
use PHPUnit\Framework\TestCase;

class AnimateItemCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myComponent';
        $duration = 1000;
        $easing = 'ease-in-out';
        $repeatCount = 3;
        $repeatMode = RepeatMode::REVERSE;
        $value = $this->createMock(Value::class);

        $command = new AnimateItemCommand($componentId, $duration, $easing, $repeatCount, $repeatMode, $value);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($duration, $command->duration);
        $this->assertSame($easing, $command->easing);
        $this->assertSame($repeatCount, $command->repeatCount);
        $this->assertSame($repeatMode, $command->repeatMode);
        $this->assertSame($value, $command->value);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new AnimateItemCommand();

        $this->assertNull($command->componentId);
        $this->assertNull($command->duration);
        $this->assertNull($command->easing);
        $this->assertNull($command->repeatCount);
        $this->assertNull($command->repeatMode);
        $this->assertNull($command->value);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testComponent';
        $duration = 2000;
        $easing = 'linear';
        $repeatCount = 5;
        $repeatMode = RepeatMode::RESTART;
        $value = $this->createMock(Value::class);

        $command = new AnimateItemCommand($componentId, $duration, $easing, $repeatCount, $repeatMode, $value);
        $result = $command->jsonSerialize();

        $this->assertSame(AnimateItemCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($duration, $result['duration']);
        $this->assertSame($easing, $result['easing']);
        $this->assertSame($repeatCount, $result['repeatCount']);
        $this->assertSame($repeatMode->value, $result['repeatMode']);
        $this->assertSame($value, $result['value']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new AnimateItemCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(AnimateItemCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('duration', $result);
        $this->assertArrayNotHasKey('easing', $result);
        $this->assertArrayNotHasKey('repeatCount', $result);
        $this->assertArrayNotHasKey('repeatMode', $result);
        $this->assertArrayNotHasKey('value', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = new AnimateItemCommand('component1', 500);
        $result = $command->jsonSerialize();

        $this->assertSame(AnimateItemCommand::TYPE, $result['type']);
        $this->assertSame('component1', $result['componentId']);
        $this->assertSame(500, $result['duration']);
        $this->assertArrayNotHasKey('easing', $result);
        $this->assertArrayNotHasKey('repeatCount', $result);
        $this->assertArrayNotHasKey('repeatMode', $result);
        $this->assertArrayNotHasKey('value', $result);
    }
}
