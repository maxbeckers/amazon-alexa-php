<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ExportItem;
use PHPUnit\Framework\TestCase;

class ExportItemTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $name = 'testItem';
        $description = 'Test description';

        $exportItem = new ExportItem($name, $description);

        $this->assertSame($name, $exportItem->name);
        $this->assertSame($description, $exportItem->description);
    }

    public function testConstructorWithDefaultDescription(): void
    {
        $name = 'myItem';

        $exportItem = new ExportItem($name);

        $this->assertSame($name, $exportItem->name);
        $this->assertSame('', $exportItem->description);
    }

    public function testJsonSerializeWithBothProperties(): void
    {
        $name = 'exportedItem';
        $description = 'Detailed description';

        $exportItem = new ExportItem($name, $description);
        $result = $exportItem->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertSame($description, $result['description']);
    }

    public function testJsonSerializeWithEmptyDescription(): void
    {
        $name = 'itemWithoutDescription';

        $exportItem = new ExportItem($name, '');
        $result = $exportItem->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithDefaultDescription(): void
    {
        $name = 'defaultDescItem';

        $exportItem = new ExportItem($name);
        $result = $exportItem->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeFiltersEmptyDescription(): void
    {
        $exportItem = new ExportItem('test', '');
        $result = $exportItem->jsonSerialize();

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeWithNonEmptyDescription(): void
    {
        $exportItem = new ExportItem('test', 'Valid description');
        $result = $exportItem->jsonSerialize();

        $this->assertCount(2, $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertSame('Valid description', $result['description']);
    }

    public function testJsonSerializeWithWhitespaceDescription(): void
    {
        $exportItem = new ExportItem('test', '   ');
        $result = $exportItem->jsonSerialize();

        $this->assertArrayHasKey('description', $result);
        $this->assertSame('   ', $result['description']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $exportItem = new ExportItem('test');

        $this->assertInstanceOf(\JsonSerializable::class, $exportItem);
    }
}
