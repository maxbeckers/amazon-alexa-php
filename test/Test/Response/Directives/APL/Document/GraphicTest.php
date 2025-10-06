<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\AVGItem;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Graphic;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Parameter;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ScaleType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Style;
use PHPUnit\Framework\TestCase;

class GraphicTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $height = 200;
        $width = 300;
        $data = ['key' => 'value'];
        $description = 'Test graphic';
        $item = $this->createMock(AVGItem::class);
        $items = [$this->createMock(AVGItem::class)];
        $lang = 'en-US';
        $layoutDirection = LayoutDirection::RTL;
        $parameters = [$this->createMock(Parameter::class)];
        $resources = ['resource1'];
        $scaleTypeHeight = ScaleType::STRETCH;
        $scaleTypeWidth = ScaleType::GROW;
        $styles = [$this->createMock(Style::class)];
        $type = 'AVG';
        $version = '1.3';
        $viewportHeight = 400;
        $viewportWidth = 500;

        $graphic = new Graphic(
            $height,
            $width,
            $data,
            $description,
            $item,
            $items,
            $lang,
            $layoutDirection,
            $parameters,
            $resources,
            $scaleTypeHeight,
            $scaleTypeWidth,
            $styles,
            $type,
            $version,
            $viewportHeight,
            $viewportWidth
        );

        $this->assertSame($height, $graphic->height);
        $this->assertSame($width, $graphic->width);
        $this->assertSame($data, $graphic->data);
        $this->assertSame($description, $graphic->description);
        $this->assertSame($item, $graphic->item);
        $this->assertSame($items, $graphic->items);
        $this->assertSame($lang, $graphic->lang);
        $this->assertSame($layoutDirection, $graphic->layoutDirection);
        $this->assertSame($parameters, $graphic->parameters);
        $this->assertSame($resources, $graphic->resources);
        $this->assertSame($scaleTypeHeight, $graphic->scaleTypeHeight);
        $this->assertSame($scaleTypeWidth, $graphic->scaleTypeWidth);
        $this->assertSame($styles, $graphic->styles);
        $this->assertSame($type, $graphic->type);
        $this->assertSame($version, $graphic->version);
        $this->assertSame($viewportHeight, $graphic->viewportHeight);
        $this->assertSame($viewportWidth, $graphic->viewportWidth);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $height = 100;
        $width = 150;

        $graphic = new Graphic($height, $width);

        $this->assertSame($height, $graphic->height);
        $this->assertSame($width, $graphic->width);
        $this->assertNull($graphic->data);
        $this->assertSame('', $graphic->description);
        $this->assertNull($graphic->item);
        $this->assertNull($graphic->items);
        $this->assertNull($graphic->lang);
        $this->assertSame(LayoutDirection::LTR, $graphic->layoutDirection);
        $this->assertSame([], $graphic->parameters);
        $this->assertSame([], $graphic->resources);
        $this->assertSame(ScaleType::NONE, $graphic->scaleTypeHeight);
        $this->assertSame(ScaleType::NONE, $graphic->scaleTypeWidth);
        $this->assertSame([], $graphic->styles);
        $this->assertSame('AVG', $graphic->type);
        $this->assertSame('1.2', $graphic->version);
        $this->assertNull($graphic->viewportHeight);
        $this->assertNull($graphic->viewportWidth);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $data = ['test' => 'data'];
        $item = $this->createMock(AVGItem::class);
        $items = [$this->createMock(AVGItem::class)];
        $parameters = [$this->createMock(Parameter::class)];
        $resources = ['resource'];
        $styles = [$this->createMock(Style::class)];

        $graphic = new Graphic(
            height: 200,
            width: 300,
            data: $data,
            description: 'Test',
            item: $item,
            items: $items,
            lang: 'fr-FR',
            layoutDirection: LayoutDirection::RTL,
            parameters: $parameters,
            resources: $resources,
            scaleTypeHeight: ScaleType::GROW,
            scaleTypeWidth: ScaleType::STRETCH,
            styles: $styles,
            type: 'AVG',
            version: '1.4',
            viewportHeight: 400,
            viewportWidth: 500
        );

        $result = $graphic->jsonSerialize();

        $this->assertSame($data, $result['data']);
        $this->assertSame('Test', $result['description']);
        $this->assertSame(200, $result['height']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
        $this->assertSame('fr-FR', $result['lang']);
        $this->assertSame(LayoutDirection::RTL, $result['layoutDirection']);
        $this->assertSame($parameters, $result['parameters']);
        $this->assertSame($resources, $result['resources']);
        $this->assertSame(ScaleType::GROW, $result['scaleTypeHeight']);
        $this->assertSame(ScaleType::STRETCH, $result['scaleTypeWidth']);
        $this->assertIsArray($result['styles']);
        $this->assertSame('AVG', $result['type']);
        $this->assertSame('1.4', $result['version']);
        $this->assertSame(400, $result['viewportHeight']);
        $this->assertSame(500, $result['viewportWidth']);
        $this->assertSame(300, $result['width']);
    }

    public function testJsonSerializeFiltersNullValues(): void
    {
        $graphic = new Graphic(100, 200);
        $result = $graphic->jsonSerialize();

        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('lang', $result);
        $this->assertArrayNotHasKey('viewportHeight', $result);
        $this->assertArrayNotHasKey('viewportWidth', $result);
    }

    public function testJsonSerializeFiltersEmptyArrays(): void
    {
        $graphic = new Graphic(100, 200, [], '', null, [], null, LayoutDirection::LTR, [], [], ScaleType::NONE, ScaleType::NONE, []);
        $result = $graphic->jsonSerialize();

        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('resources', $result);
        $this->assertArrayNotHasKey('styles', $result);
    }

    public function testJsonSerializeKeepsNonEmptyArrays(): void
    {
        $parameters = [$this->createMock(Parameter::class)];
        $resources = ['test'];
        $styles = [$this->createMock(Style::class)];

        $graphic = new Graphic(100, 200, null, '', null, null, null, LayoutDirection::LTR, $parameters, $resources, ScaleType::NONE, ScaleType::NONE, $styles);
        $result = $graphic->jsonSerialize();

        $this->assertArrayHasKey('parameters', $result);
        $this->assertArrayHasKey('resources', $result);
        $this->assertArrayHasKey('styles', $result);
        $this->assertSame($parameters, $result['parameters']);
        $this->assertSame($resources, $result['resources']);
        $this->assertIsArray($result['styles']);
    }

    public function testJsonSerializeStylesAsArray(): void
    {
        $styles = [$this->createMock(Style::class)];
        $graphic = new Graphic(100, 200, styles: $styles);
        $result = $graphic->jsonSerialize();

        $this->assertIsArray($result['styles']);
    }

    public function testJsonSerializeWithDifferentScaleTypes(): void
    {
        $scaleTypes = [ScaleType::NONE, ScaleType::GROW, ScaleType::STRETCH];

        foreach ($scaleTypes as $scaleType) {
            $graphic = new Graphic(100, 200, scaleTypeHeight: $scaleType, scaleTypeWidth: $scaleType);
            $result = $graphic->jsonSerialize();

            $this->assertSame($scaleType, $result['scaleTypeHeight']);
            $this->assertSame($scaleType, $result['scaleTypeWidth']);
        }
    }

    public function testJsonSerializeWithDifferentLayoutDirections(): void
    {
        $directions = [LayoutDirection::LTR, LayoutDirection::RTL];

        foreach ($directions as $direction) {
            $graphic = new Graphic(100, 200, layoutDirection: $direction);
            $result = $graphic->jsonSerialize();

            $this->assertSame($direction, $result['layoutDirection']);
        }
    }

    public function testImplementsJsonSerializable(): void
    {
        $graphic = new Graphic(100, 200);

        $this->assertInstanceOf(\JsonSerializable::class, $graphic);
    }
}
