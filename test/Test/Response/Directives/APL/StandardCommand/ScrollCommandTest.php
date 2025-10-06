<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\ScrollCommand;
use PHPUnit\Framework\TestCase;

class ScrollCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myScrollContainer';
        $distance = 500;
        $targetDuration = 1000;

        $command = new ScrollCommand($componentId, $distance, $targetDuration);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($distance, $command->distance);
        $this->assertSame($targetDuration, $command->targetDuration);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new ScrollCommand();

        $this->assertNull($command->componentId);
        $this->assertNull($command->distance);
        $this->assertNull($command->targetDuration);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testScroller';
        $distance = 300;
        $targetDuration = 800;

        $command = new ScrollCommand($componentId, $distance, $targetDuration);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($distance, $result['distance']);
        $this->assertSame($targetDuration, $result['targetDuration']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new ScrollCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('distance', $result);
        $this->assertArrayNotHasKey('targetDuration', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = new ScrollCommand('scroller1', 100);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollCommand::TYPE, $result['type']);
        $this->assertSame('scroller1', $result['componentId']);
        $this->assertSame(100, $result['distance']);
        $this->assertArrayNotHasKey('targetDuration', $result);
    }

    public function testJsonSerializeWithNegativeDistance(): void
    {
        $command = new ScrollCommand('scroller', -200, 500);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollCommand::TYPE, $result['type']);
        $this->assertSame('scroller', $result['componentId']);
        $this->assertSame(-200, $result['distance']);
        $this->assertSame(500, $result['targetDuration']);
    }

    public function testJsonSerializeWithZeroValues(): void
    {
        $command = new ScrollCommand('scroller', 0, 0);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollCommand::TYPE, $result['type']);
        $this->assertSame('scroller', $result['componentId']);
        $this->assertSame(0, $result['distance']);
        $this->assertSame(0, $result['targetDuration']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $command = new ScrollCommand();

        $this->assertInstanceOf(\JsonSerializable::class, $command);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('Scroll', ScrollCommand::TYPE);
    }
}
