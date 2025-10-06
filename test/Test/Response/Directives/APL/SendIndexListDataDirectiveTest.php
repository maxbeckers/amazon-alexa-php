<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\SendIndexListDataDirective;
use PHPUnit\Framework\TestCase;

class SendIndexListDataDirectiveTest extends TestCase
{
    public function testConstructorAndBaseSerialization(): void
    {
        $d = new SendIndexListDataDirective(
            listId: 'list-123',
            startIndex: 10,
            correlationToken: 'corr-1',
            listVersion: 5,
            minimumInclusiveIndex: '10',
            maximumExclusiveIndex: '20'
        );

        $json = $d->jsonSerialize();
        $this->assertSame(SendIndexListDataDirective::TYPE, $json['type']);
        $this->assertSame('list-123', $json['listId']);
        $this->assertSame(10, $json['startIndex']);
        $this->assertSame('corr-1', $json['correlationToken']);
        $this->assertSame(5, $json['listVersion']);
        $this->assertSame('10', $json['minimumInclusiveIndex']);
        $this->assertSame('20', $json['maximumExclusiveIndex']);
        $this->assertArrayNotHasKey('items', $json);
    }

    public function testAddItem(): void
    {
        $d = new SendIndexListDataDirective('list', 0);
        $d->addItem(['id' => 1]);
        $d->addItem(['id' => 2]);

        $json = $d->jsonSerialize();
        $this->assertArrayHasKey('items', $json);
        $this->assertCount(2, $json['items']);
        $this->assertSame(['id' => 1], $json['items'][0]);
    }

    public function testSerializationOmitsNullAndEmpty(): void
    {
        $d = new SendIndexListDataDirective('list', 3);
        $json = $d->jsonSerialize();

        $this->assertSame(SendIndexListDataDirective::TYPE, $json['type']);
        $this->assertSame('list', $json['listId']);
        $this->assertSame(3, $json['startIndex']);
        $this->assertCount(3, $json); // type, listId, startIndex
        $this->assertArrayNotHasKey('items', $json);
        $this->assertArrayNotHasKey('correlationToken', $json);
    }
}
