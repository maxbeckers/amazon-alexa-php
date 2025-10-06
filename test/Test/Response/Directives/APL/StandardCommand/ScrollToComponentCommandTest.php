<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ScrollAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\ScrollToComponentCommand;
use PHPUnit\Framework\TestCase;

class ScrollToComponentCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'targetComponent';
        $align = ScrollAlign::CENTER;
        $targetDuration = 1000;

        $command = new ScrollToComponentCommand($componentId, $align, $targetDuration);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($align, $command->align);
        $this->assertSame($targetDuration, $command->targetDuration);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new ScrollToComponentCommand();

        $this->assertNull($command->componentId);
        $this->assertSame(ScrollAlign::VISIBLE, $command->align);
        $this->assertNull($command->targetDuration);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testComponent';
        $align = ScrollAlign::FIRST;
        $targetDuration = 800;

        $command = new ScrollToComponentCommand($componentId, $align, $targetDuration);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollToComponentCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($align->value, $result['align']);
        $this->assertSame($targetDuration, $result['targetDuration']);
    }

    public function testJsonSerializeWithDefaultAlign(): void
    {
        $command = new ScrollToComponentCommand('component1');
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollToComponentCommand::TYPE, $result['type']);
        $this->assertSame('component1', $result['componentId']);
        $this->assertSame(ScrollAlign::VISIBLE->value, $result['align']);
        $this->assertArrayNotHasKey('targetDuration', $result);
    }

    public function testJsonSerializeWithNullComponentId(): void
    {
        $command = new ScrollToComponentCommand(null, ScrollAlign::LAST, 500);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollToComponentCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertSame(ScrollAlign::LAST->value, $result['align']);
        $this->assertSame(500, $result['targetDuration']);
    }

    public function testJsonSerializeWithDifferentAlignValues(): void
    {
        $alignValues = [ScrollAlign::VISIBLE, ScrollAlign::CENTER, ScrollAlign::FIRST, ScrollAlign::LAST];

        foreach ($alignValues as $align) {
            $command = new ScrollToComponentCommand('test', $align);
            $result = $command->jsonSerialize();

            $this->assertSame($align->value, $result['align']);
        }
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('ScrollToComponent', ScrollToComponentCommand::TYPE);
    }
}
