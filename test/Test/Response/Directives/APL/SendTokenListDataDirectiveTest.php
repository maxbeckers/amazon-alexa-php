<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\SendTokenListDataDirective;
use PHPUnit\Framework\TestCase;

class SendTokenListDataDirectiveTest extends TestCase
{
    public function testConstructorAndSerialization(): void
    {
        $d = new SendTokenListDataDirective(
            listId: 'list-x',
            pageToken: 'page-1',
            correlationToken: 'corr-123',
            nextPageToken: 'page-2'
        );

        $json = $d->jsonSerialize();
        $this->assertSame(SendTokenListDataDirective::TYPE, $json['type']);
        $this->assertSame('list-x', $json['listId']);
        $this->assertSame('page-1', $json['pageToken']);
        $this->assertSame('corr-123', $json['correlationToken']);
        $this->assertSame('page-2', $json['nextPageToken']);
        $this->assertArrayNotHasKey('items', $json);
    }

    public function testAddItem(): void
    {
        $d = new SendTokenListDataDirective('list-z', 'p');
        $d->addItem(['k' => 'v']);
        $d->addItem(['k' => 'w']);

        $json = $d->jsonSerialize();
        $this->assertArrayHasKey('items', $json);
        $this->assertCount(2, $json['items']);
        $this->assertSame(['k' => 'v'], $json['items'][0]);
    }

    public function testSerializationOmitsNullAndEmpty(): void
    {
        $d = new SendTokenListDataDirective('list-empty', 'token-empty');
        $json = $d->jsonSerialize();

        $this->assertSame(SendTokenListDataDirective::TYPE, $json['type']);
        $this->assertSame('list-empty', $json['listId']);
        $this->assertSame('token-empty', $json['pageToken']);
        $this->assertCount(3, $json); // type, listId, pageToken
        $this->assertArrayNotHasKey('items', $json);
        $this->assertArrayNotHasKey('correlationToken', $json);
        $this->assertArrayNotHasKey('nextPageToken', $json);
    }
}
