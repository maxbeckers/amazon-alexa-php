<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Export;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ExportItem;
use PHPUnit\Framework\TestCase;

class ExportTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $graphics = [$this->createMock(ExportItem::class)];
        $layouts = [
            $this->createMock(ExportItem::class),
            $this->createMock(ExportItem::class),
        ];
        $resources = [$this->createMock(ExportItem::class)];
        $styles = [
            $this->createMock(ExportItem::class),
            $this->createMock(ExportItem::class),
            $this->createMock(ExportItem::class),
        ];

        $export = new Export($graphics, $layouts, $resources, $styles);

        $this->assertSame($graphics, $export->graphics);
        $this->assertSame($layouts, $export->layouts);
        $this->assertSame($resources, $export->resources);
        $this->assertSame($styles, $export->styles);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $export = new Export();

        $this->assertEmpty($export->graphics);
        $this->assertEmpty($export->layouts);
        $this->assertEmpty($export->resources);
        $this->assertEmpty($export->styles);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $graphics = [$this->createMock(ExportItem::class)];
        $layouts = [
            $this->createMock(ExportItem::class),
            $this->createMock(ExportItem::class),
        ];
        $resources = [$this->createMock(ExportItem::class)];
        $styles = [$this->createMock(ExportItem::class)];

        $export = new Export($graphics, $layouts, $resources, $styles);
        $result = $export->jsonSerialize();

        $this->assertSame($graphics, $result['graphics']);
        $this->assertSame($layouts, $result['layouts']);
        $this->assertSame($resources, $result['resources']);
        $this->assertSame($styles, $result['styles']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $export = new Export();
        $result = $export->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('graphics', $result);
        $this->assertArrayNotHasKey('layouts', $result);
        $this->assertArrayNotHasKey('resources', $result);
        $this->assertArrayNotHasKey('styles', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $layouts = [$this->createMock(ExportItem::class)];
        $styles = [
            $this->createMock(ExportItem::class),
            $this->createMock(ExportItem::class),
        ];

        $export = new Export([], $layouts, [], $styles);
        $result = $export->jsonSerialize();

        $this->assertSame($layouts, $result['layouts']);
        $this->assertSame($styles, $result['styles']);
        $this->assertArrayNotHasKey('graphics', $result);
        $this->assertArrayNotHasKey('resources', $result);
    }

    public function testJsonSerializeWithOnlyGraphics(): void
    {
        $graphics = [
            $this->createMock(ExportItem::class),
            $this->createMock(ExportItem::class),
        ];

        $export = new Export($graphics);
        $result = $export->jsonSerialize();

        $this->assertSame($graphics, $result['graphics']);
        $this->assertArrayNotHasKey('layouts', $result);
        $this->assertArrayNotHasKey('resources', $result);
        $this->assertArrayNotHasKey('styles', $result);
    }

    public function testJsonSerializeWithOnlyLayouts(): void
    {
        $layouts = [$this->createMock(ExportItem::class)];

        $export = new Export([], $layouts);
        $result = $export->jsonSerialize();

        $this->assertSame($layouts, $result['layouts']);
        $this->assertArrayNotHasKey('graphics', $result);
        $this->assertArrayNotHasKey('resources', $result);
        $this->assertArrayNotHasKey('styles', $result);
    }

    public function testJsonSerializeWithOnlyResources(): void
    {
        $resources = [
            $this->createMock(ExportItem::class),
            $this->createMock(ExportItem::class),
            $this->createMock(ExportItem::class),
        ];

        $export = new Export([], [], $resources);
        $result = $export->jsonSerialize();

        $this->assertSame($resources, $result['resources']);
        $this->assertArrayNotHasKey('graphics', $result);
        $this->assertArrayNotHasKey('layouts', $result);
        $this->assertArrayNotHasKey('styles', $result);
    }

    public function testJsonSerializeWithOnlyStyles(): void
    {
        $styles = [$this->createMock(ExportItem::class)];

        $export = new Export([], [], [], $styles);
        $result = $export->jsonSerialize();

        $this->assertSame($styles, $result['styles']);
        $this->assertArrayNotHasKey('graphics', $result);
        $this->assertArrayNotHasKey('layouts', $result);
        $this->assertArrayNotHasKey('resources', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $export = new Export();

        $this->assertInstanceOf(\JsonSerializable::class, $export);
    }
}
