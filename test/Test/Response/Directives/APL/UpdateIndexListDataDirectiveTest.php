<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\UpdateIndexListDataDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\UpdateIndexListDataOperationType;
use PHPUnit\Framework\TestCase;

class UpdateIndexListDataDirectiveTest extends TestCase
{
    public function testConstructorAndJsonSerialize(): void
    {
        $directive = new UpdateIndexListDataDirective('tok', 'list-1', 5);
        $json = $directive->jsonSerialize();

        $this->assertSame(UpdateIndexListDataDirective::TYPE, $json['type']);
        $this->assertSame('tok', $json['token']);
        $this->assertSame('list-1', $json['listId']);
        $this->assertSame(5, $json['listVersion']);
        $this->assertSame([], $json['operations']);
    }

    public function testConstructorSerializationEmptyOps(): void
    {
        $d = new UpdateIndexListDataDirective('tok-1', 'list-a', 7);
        $json = $d->jsonSerialize();

        $this->assertSame(UpdateIndexListDataDirective::TYPE, $json['type']);
        $this->assertSame('tok-1', $json['token']);
        $this->assertSame('list-a', $json['listId']);
        $this->assertSame(7, $json['listVersion']);
        $this->assertIsArray($json['operations']);
        $this->assertCount(0, $json['operations']);
    }

    public function testAddOperation(): void
    {
        $d = new UpdateIndexListDataDirective('tok-2', 'list-b', 1);
        $d->addOperation(['type' => 'CustomType', 'meta' => 9]);

        $ops = $d->jsonSerialize()['operations'];
        $this->assertCount(1, $ops);
        $this->assertSame('CustomType', $ops[0]['type']);
        $this->assertSame(9, $ops[0]['meta']);
    }

    public function testAddInsertItemOperation(): void
    {
        $directive = new UpdateIndexListDataDirective('t', 'l', 2);
        $directive->addInsertItemOperation(3, ['value' => 'x']);

        $op = $directive->jsonSerialize()['operations'][0];
        $this->assertSame(UpdateIndexListDataOperationType::INSERT_ITEM->value, $op['type']);
        $this->assertSame(3, $op['index']);
        $this->assertSame(['value' => 'x'], $op['item']);
    }

    public function testAddInsertMultipleItemsOperation(): void
    {
        $items = [['id' => 1], ['id' => 2]];
        $directive = new UpdateIndexListDataDirective('t', 'l', 3);
        $directive->addInsertMultipleItemsOperation(4, $items);

        $op = $directive->jsonSerialize()['operations'][0];
        $this->assertSame(UpdateIndexListDataOperationType::INSERT_MULTIPLE_ITEMS->value, $op['type']);
        $this->assertSame(4, $op['index']);
        $this->assertSame($items, $op['items']);
    }

    public function testAddSetItemOperation(): void
    {
        $directive = new UpdateIndexListDataDirective('t', 'l', 4);
        $directive->addSetItemOperation(5, ['u' => 'v']);

        $op = $directive->jsonSerialize()['operations'][0];
        $this->assertSame(UpdateIndexListDataOperationType::SET_ITEM->value, $op['type']);
        $this->assertSame(5, $op['index']);
        $this->assertSame(['u' => 'v'], $op['item']);
    }

    public function testAddDeleteItemOperation(): void
    {
        $directive = new UpdateIndexListDataDirective('t', 'l', 5);
        $directive->addDeleteItemOperation(6);

        $op = $directive->jsonSerialize()['operations'][0];
        $this->assertSame(UpdateIndexListDataOperationType::DELETE_ITEM->value, $op['type']);
        $this->assertSame(6, $op['index']);
        $this->assertArrayNotHasKey('item', $op);
    }

    public function testAddDeleteMultipleItemsOperation(): void
    {
        $directive = new UpdateIndexListDataDirective('t', 'l', 6);
        $directive->addDeleteMultipleItemsOperation(7, 3);

        $op = $directive->jsonSerialize()['operations'][0];
        $this->assertSame(UpdateIndexListDataOperationType::DELETE_MULTIPLE_ITEMS->value, $op['type']);
        $this->assertSame(7, $op['index']);
        $this->assertSame(3, $op['count']);
    }

    public function testMultipleOperationsOrderPreserved(): void
    {
        $d = new UpdateIndexListDataDirective('tok', 'lst', 9);
        $d->addInsertItemOperation(0, ['id' => 1]);
        $d->addDeleteItemOperation(2);
        $d->addSetItemOperation(1, ['id' => 2]);

        $ops = $d->jsonSerialize()['operations'];
        $this->assertCount(3, $ops);
        $this->assertSame(UpdateIndexListDataOperationType::INSERT_ITEM->value, $ops[0]['type']);
        $this->assertSame(UpdateIndexListDataOperationType::DELETE_ITEM->value, $ops[1]['type']);
        $this->assertSame(UpdateIndexListDataOperationType::SET_ITEM->value, $ops[2]['type']);
    }
}
