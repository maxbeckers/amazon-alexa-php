<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\HighlightMode;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ScrollAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SpeakItemCommand;
use PHPUnit\Framework\TestCase;

class SpeakItemCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myComponent';
        $align = ScrollAlign::CENTER;
        $highlightMode = HighlightMode::LINE;
        $minimumDwellTime = 1000;

        $command = new SpeakItemCommand($componentId, $align, $highlightMode, $minimumDwellTime);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($align, $command->align);
        $this->assertSame($highlightMode, $command->highlightMode);
        $this->assertSame($minimumDwellTime, $command->minimumDwellTime);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new SpeakItemCommand();

        $this->assertNull($command->componentId);
        $this->assertSame(ScrollAlign::VISIBLE, $command->align);
        $this->assertSame(HighlightMode::BLOCK, $command->highlightMode);
        $this->assertNull($command->minimumDwellTime);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testComponent';
        $align = ScrollAlign::FIRST;
        $highlightMode = HighlightMode::BLOCK;
        $minimumDwellTime = 500;

        $command = new SpeakItemCommand($componentId, $align, $highlightMode, $minimumDwellTime);
        $result = $command->jsonSerialize();

        $this->assertSame(SpeakItemCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($align->value, $result['align']);
        $this->assertSame($highlightMode->value, $result['highlightMode']);
        $this->assertSame($minimumDwellTime, $result['minimumDwellTime']);
    }

    public function testJsonSerializeWithDefaultEnums(): void
    {
        $command = new SpeakItemCommand('component1');
        $result = $command->jsonSerialize();

        $this->assertSame(SpeakItemCommand::TYPE, $result['type']);
        $this->assertSame('component1', $result['componentId']);
        $this->assertSame(ScrollAlign::VISIBLE->value, $result['align']);
        $this->assertSame(HighlightMode::BLOCK->value, $result['highlightMode']);
        $this->assertArrayNotHasKey('minimumDwellTime', $result);
    }

    public function testJsonSerializeWithNullComponentId(): void
    {
        $command = new SpeakItemCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(SpeakItemCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertSame(ScrollAlign::VISIBLE->value, $result['align']);
        $this->assertSame(HighlightMode::BLOCK->value, $result['highlightMode']);
        $this->assertArrayNotHasKey('minimumDwellTime', $result);
    }

    public function testJsonSerializeWithZeroDwellTime(): void
    {
        $command = new SpeakItemCommand('component', ScrollAlign::LAST, HighlightMode::LINE, 0);
        $result = $command->jsonSerialize();

        $this->assertSame(0, $result['minimumDwellTime']);
    }

    public function testJsonSerializeWithDifferentAlignValues(): void
    {
        $alignValues = [ScrollAlign::VISIBLE, ScrollAlign::CENTER, ScrollAlign::FIRST, ScrollAlign::LAST];

        foreach ($alignValues as $align) {
            $command = new SpeakItemCommand('test', $align);
            $result = $command->jsonSerialize();

            $this->assertSame($align->value, $result['align']);
        }
    }

    public function testJsonSerializeWithDifferentHighlightModes(): void
    {
        $highlightModes = [HighlightMode::BLOCK, HighlightMode::LINE];

        foreach ($highlightModes as $mode) {
            $command = new SpeakItemCommand('test', ScrollAlign::VISIBLE, $mode);
            $result = $command->jsonSerialize();

            $this->assertSame($mode->value, $result['highlightMode']);
        }
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('SpeakItem', SpeakItemCommand::TYPE);
    }
}
