<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AutoPageCommand;
use PHPUnit\Framework\TestCase;

class AutoPageCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $componentId = 'myPager';
        $count = 3;
        $duration = 5000;
        $transitionDuration = 500;

        $command = new AutoPageCommand($componentId, $count, $duration, $transitionDuration);

        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($count, $command->count);
        $this->assertSame($duration, $command->duration);
        $this->assertSame($transitionDuration, $command->transitionDuration);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new AutoPageCommand();

        $this->assertNull($command->componentId);
        $this->assertNull($command->count);
        $this->assertNull($command->duration);
        $this->assertNull($command->transitionDuration);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $componentId = 'testPager';
        $count = 2;
        $duration = 3000;
        $transitionDuration = 300;

        $command = new AutoPageCommand($componentId, $count, $duration, $transitionDuration);
        $result = $command->jsonSerialize();

        $this->assertSame(AutoPageCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($count, $result['count']);
        $this->assertSame($duration, $result['duration']);
        $this->assertSame($transitionDuration, $result['transitionDuration']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new AutoPageCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(AutoPageCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('count', $result);
        $this->assertArrayNotHasKey('duration', $result);
        $this->assertArrayNotHasKey('transitionDuration', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = new AutoPageCommand('pager1', 1);
        $result = $command->jsonSerialize();

        $this->assertSame(AutoPageCommand::TYPE, $result['type']);
        $this->assertSame('pager1', $result['componentId']);
        $this->assertSame(1, $result['count']);
        $this->assertArrayNotHasKey('duration', $result);
        $this->assertArrayNotHasKey('transitionDuration', $result);
    }
}
