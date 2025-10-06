<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SetFocusCommand;
use PHPUnit\Framework\TestCase;

class SetFocusCommandTest extends TestCase
{
    public function testConstructorWithComponentId(): void
    {
        $componentId = 'myComponent';

        $command = new SetFocusCommand($componentId);

        $this->assertSame($componentId, $command->componentId);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new SetFocusCommand();

        $this->assertNull($command->componentId);
    }

    public function testJsonSerializeWithComponentId(): void
    {
        $componentId = 'testComponent';

        $command = new SetFocusCommand($componentId);
        $result = $command->jsonSerialize();

        $this->assertSame(SetFocusCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
    }

    public function testJsonSerializeWithNullValue(): void
    {
        $command = new SetFocusCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(SetFocusCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
    }

    public function testJsonSerializeWithEmptyString(): void
    {
        $command = new SetFocusCommand('');
        $result = $command->jsonSerialize();

        $this->assertSame(SetFocusCommand::TYPE, $result['type']);
        $this->assertSame('', $result['componentId']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $command = new SetFocusCommand();

        $this->assertInstanceOf(\JsonSerializable::class, $command);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('SetFocus', SetFocusCommand::TYPE);
    }
}
