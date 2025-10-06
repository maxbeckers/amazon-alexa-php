<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\InsertItemCommand;
use PHPUnit\Framework\TestCase;

class InsertItemCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $at = 2;
        $componentId = 'myList';
        $item = ['type' => 'Text', 'text' => 'New Item'];
        $items = [
            ['type' => 'Text', 'text' => 'Item 1'],
            ['type' => 'Text', 'text' => 'Item 2'],
        ];

        $command = new InsertItemCommand($at, $componentId, $item, $items);

        $this->assertSame($at, $command->at);
        $this->assertSame($componentId, $command->componentId);
        $this->assertSame($item, $command->item);
        $this->assertSame($items, $command->items);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new InsertItemCommand();

        $this->assertNull($command->at);
        $this->assertNull($command->componentId);
        $this->assertNull($command->item);
        $this->assertNull($command->items);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $at = 1;
        $componentId = 'testList';
        $item = 'simple string item';
        $items = ['item1', 'item2'];

        $command = new InsertItemCommand($at, $componentId, $item, $items);
        $result = $command->jsonSerialize();

        $this->assertSame(InsertItemCommand::TYPE, $result['type']);
        $this->assertSame($at, $result['at']);
        $this->assertSame($componentId, $result['componentId']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
    }

    public function testJsonSerializeWithEmptyArray(): void
    {
        $command = new InsertItemCommand(null, null, null, []);
        $result = $command->jsonSerialize();

        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new InsertItemCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(InsertItemCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('at', $result);
        $this->assertArrayNotHasKey('componentId', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithMixedItemTypes(): void
    {
        $item = ['type' => 'Component'];
        $items = [123, 'string', ['array' => 'value']];

        $command = new InsertItemCommand(0, 'list', $item, $items);
        $result = $command->jsonSerialize();

        $this->assertSame(0, $result['at']);
        $this->assertSame('list', $result['componentId']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
    }
}
