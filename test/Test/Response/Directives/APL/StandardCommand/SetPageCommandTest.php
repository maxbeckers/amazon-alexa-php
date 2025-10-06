<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SetPagePosition;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SetPageCommand;
use PHPUnit\Framework\TestCase;

class SetPageCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myPager';
        $position = SetPagePosition::RELATIVE;
        $transitionDuration = 500;
        $value = 2;

        $command = new SetPageCommand($componentId, $position, $transitionDuration, $value);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($position, $command->position);
        $this->assertSame($transitionDuration, $command->transitionDuration);
        $this->assertSame($value, $command->value);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new SetPageCommand();

        $this->assertNull($command->componentId);
        $this->assertSame(SetPagePosition::ABSOLUTE, $command->position);
        $this->assertNull($command->transitionDuration);
        $this->assertNull($command->value);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testPager';
        $position = SetPagePosition::RELATIVE;
        $transitionDuration = 300;
        $value = 1;

        $command = new SetPageCommand($componentId, $position, $transitionDuration, $value);
        $result = $command->jsonSerialize();

        $this->assertSame(SetPageCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($position->value, $result['position']);
        $this->assertSame($transitionDuration, $result['transitionDuration']);
        $this->assertSame($value, $result['value']);
    }

    public function testJsonSerializeWithDefaultPosition(): void
    {
        $command = new SetPageCommand('pager1');
        $result = $command->jsonSerialize();

        $this->assertSame(SetPageCommand::TYPE, $result['type']);
        $this->assertSame('pager1', $result['componentId']);
        $this->assertSame(SetPagePosition::ABSOLUTE->value, $result['position']);
        $this->assertArrayNotHasKey('transitionDuration', $result);
        $this->assertArrayNotHasKey('value', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new SetPageCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(SetPageCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertSame(SetPagePosition::ABSOLUTE->value, $result['position']);
        $this->assertArrayNotHasKey('transitionDuration', $result);
        $this->assertArrayNotHasKey('value', $result);
    }

    public function testJsonSerializeWithZeroValues(): void
    {
        $command = new SetPageCommand('pager', SetPagePosition::RELATIVE, 0, 0);
        $result = $command->jsonSerialize();

        $this->assertSame(SetPageCommand::TYPE, $result['type']);
        $this->assertSame('pager', $result['componentId']);
        $this->assertSame(SetPagePosition::RELATIVE->value, $result['position']);
        $this->assertSame(0, $result['transitionDuration']);
        $this->assertSame(0, $result['value']);
    }

    public function testJsonSerializeWithNegativeValue(): void
    {
        $command = new SetPageCommand('pager', SetPagePosition::RELATIVE, 200, -1);
        $result = $command->jsonSerialize();

        $this->assertSame(-1, $result['value']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('SetPage', SetPageCommand::TYPE);
    }
}
