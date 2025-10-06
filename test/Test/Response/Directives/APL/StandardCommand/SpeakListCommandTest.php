<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ScrollAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SpeakListCommand;
use PHPUnit\Framework\TestCase;

class SpeakListCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myList';
        $align = ScrollAlign::CENTER;
        $count = 5;
        $minimumDwellTime = 800;
        $start = 2;

        $command = new SpeakListCommand($componentId, $align, $count, $minimumDwellTime, $start);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($align, $command->align);
        $this->assertSame($count, $command->count);
        $this->assertSame($minimumDwellTime, $command->minimumDwellTime);
        $this->assertSame($start, $command->start);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new SpeakListCommand();

        $this->assertNull($command->componentId);
        $this->assertSame(ScrollAlign::VISIBLE, $command->align);
        $this->assertNull($command->count);
        $this->assertNull($command->minimumDwellTime);
        $this->assertNull($command->start);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testList';
        $align = ScrollAlign::FIRST;
        $count = 3;
        $minimumDwellTime = 600;
        $start = 1;

        $command = new SpeakListCommand($componentId, $align, $count, $minimumDwellTime, $start);
        $result = $command->jsonSerialize();

        $this->assertSame(SpeakListCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($align->value, $result['align']);
        $this->assertSame($count, $result['count']);
        $this->assertSame($minimumDwellTime, $result['minimumDwellTime']);
        $this->assertSame($start, $result['start']);
    }

    public function testJsonSerializeWithDefaultAlign(): void
    {
        $command = new SpeakListCommand('list1');
        $result = $command->jsonSerialize();

        $this->assertSame(SpeakListCommand::TYPE, $result['type']);
        $this->assertSame('list1', $result['componentId']);
        $this->assertSame(ScrollAlign::VISIBLE->value, $result['align']);
        $this->assertArrayNotHasKey('count', $result);
        $this->assertArrayNotHasKey('minimumDwellTime', $result);
        $this->assertArrayNotHasKey('start', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new SpeakListCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(SpeakListCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertSame(ScrollAlign::VISIBLE->value, $result['align']);
        $this->assertArrayNotHasKey('count', $result);
        $this->assertArrayNotHasKey('minimumDwellTime', $result);
        $this->assertArrayNotHasKey('start', $result);
    }

    public function testJsonSerializeWithZeroValues(): void
    {
        $command = new SpeakListCommand('list', ScrollAlign::LAST, 0, 0, 0);
        $result = $command->jsonSerialize();

        $this->assertSame(SpeakListCommand::TYPE, $result['type']);
        $this->assertSame('list', $result['componentId']);
        $this->assertSame(ScrollAlign::LAST->value, $result['align']);
        $this->assertSame(0, $result['count']);
        $this->assertSame(0, $result['minimumDwellTime']);
        $this->assertSame(0, $result['start']);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = new SpeakListCommand('list', ScrollAlign::CENTER, 10);
        $result = $command->jsonSerialize();

        $this->assertSame(SpeakListCommand::TYPE, $result['type']);
        $this->assertSame('list', $result['componentId']);
        $this->assertSame(ScrollAlign::CENTER->value, $result['align']);
        $this->assertSame(10, $result['count']);
        $this->assertArrayNotHasKey('minimumDwellTime', $result);
        $this->assertArrayNotHasKey('start', $result);
    }

    public function testJsonSerializeWithDifferentAlignValues(): void
    {
        $alignValues = [ScrollAlign::VISIBLE, ScrollAlign::CENTER, ScrollAlign::FIRST, ScrollAlign::LAST];

        foreach ($alignValues as $align) {
            $command = new SpeakListCommand('test', $align);
            $result = $command->jsonSerialize();

            $this->assertSame($align->value, $result['align']);
        }
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('SpeakList', SpeakListCommand::TYPE);
    }
}
