<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\RemoveItemCommand;
use PHPUnit\Framework\TestCase;

class RemoveItemCommandTest extends TestCase
{
    public function testConstructorWithComponentId(): void
    {
        $componentId = 'myListComponent';

        $command = new RemoveItemCommand($componentId);

        $this->assertSame($componentId, $command->componentId);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new RemoveItemCommand();

        $this->assertNull($command->componentId);
    }

    public function testJsonSerializeWithComponentId(): void
    {
        $componentId = 'testList';

        $command = new RemoveItemCommand($componentId);
        $result = $command->jsonSerialize();

        $this->assertSame(RemoveItemCommand::TYPE, $result['type']);
        $this->assertSame($componentId, $result['componentId']);
    }

    public function testJsonSerializeWithNullValue(): void
    {
        $command = new RemoveItemCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(RemoveItemCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('componentId', $result);
    }

    public function testJsonSerializeWithEmptyString(): void
    {
        $command = new RemoveItemCommand('');
        $result = $command->jsonSerialize();

        $this->assertSame(RemoveItemCommand::TYPE, $result['type']);
        $this->assertSame('', $result['componentId']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $command = new RemoveItemCommand();

        $this->assertInstanceOf(\JsonSerializable::class, $command);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('RemoveItem', RemoveItemCommand::TYPE);
    }
}
