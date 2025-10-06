<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ScrollAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\ScrollToIndexCommand;
use PHPUnit\Framework\TestCase;

class ScrollToIndexCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myList';
        $index = 5;
        $align = ScrollAlign::CENTER;
        $targetDuration = 1200;

        $command = new ScrollToIndexCommand($componentId, $index, $align, $targetDuration);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($index, $command->index);
        $this->assertSame($align, $command->align);
        $this->assertSame($targetDuration, $command->targetDuration);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new ScrollToIndexCommand();

        $this->assertNull($command->componentId);
        $this->assertNull($command->index);
        $this->assertSame(ScrollAlign::VISIBLE, $command->align);
        $this->assertNull($command->targetDuration);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testList';
        $index = 3;
        $align = ScrollAlign::FIRST;
        $targetDuration = 600;

        $command = new ScrollToIndexCommand($componentId, $index, $align, $targetDuration);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollToIndexCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($index, $result['index']);
        $this->assertSame($align->value, $result['align']);
        $this->assertSame($targetDuration, $result['targetDuration']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new ScrollToIndexCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollToIndexCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('index', $result);
        $this->assertSame(ScrollAlign::VISIBLE->value, $result['align']);
        $this->assertArrayNotHasKey('targetDuration', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = new ScrollToIndexCommand('list1', 2);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollToIndexCommand::TYPE, $result['type']);
        $this->assertSame('list1', $result['componentId']);
        $this->assertSame(2, $result['index']);
        $this->assertSame(ScrollAlign::VISIBLE->value, $result['align']);
        $this->assertArrayNotHasKey('targetDuration', $result);
    }

    public function testJsonSerializeWithZeroIndex(): void
    {
        $command = new ScrollToIndexCommand('list', 0, ScrollAlign::LAST);
        $result = $command->jsonSerialize();

        $this->assertSame(ScrollToIndexCommand::TYPE, $result['type']);
        $this->assertSame('list', $result['componentId']);
        $this->assertSame(0, $result['index']);
        $this->assertSame(ScrollAlign::LAST->value, $result['align']);
    }

    public function testJsonSerializeWithNegativeIndex(): void
    {
        $command = new ScrollToIndexCommand('list', -1);
        $result = $command->jsonSerialize();

        $this->assertSame(-1, $result['index']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('ScrollToIndex', ScrollToIndexCommand::TYPE);
    }
}
