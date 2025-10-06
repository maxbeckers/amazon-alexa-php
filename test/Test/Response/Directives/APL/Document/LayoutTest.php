<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Bind;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Layout;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutParameter;
use PHPUnit\Framework\TestCase;

class LayoutTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $bind = [$this->createMock(Bind::class)];
        $description = 'Test layout';
        $item = $this->createMock(APLBaseComponent::class);
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];
        $parameters = [$this->createMock(LayoutParameter::class)];

        $layout = new Layout($bind, $description, $item, $items, $parameters);

        $this->assertSame($bind, $layout->bind);
        $this->assertSame($description, $layout->description);
        $this->assertSame($item, $layout->item);
        $this->assertSame($items, $layout->items);
        $this->assertSame($parameters, $layout->parameters);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $layout = new Layout();

        $this->assertNull($layout->bind);
        $this->assertNull($layout->description);
        $this->assertNull($layout->item);
        $this->assertNull($layout->items);
        $this->assertNull($layout->parameters);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $bind = [
            $this->createMock(Bind::class),
            $this->createMock(Bind::class),
        ];
        $description = 'Complex layout';
        $item = $this->createMock(APLBaseComponent::class);
        $items = [$this->createMock(APLBaseComponent::class)];
        $parameters = [
            $this->createMock(LayoutParameter::class),
            $this->createMock(LayoutParameter::class),
        ];

        $layout = new Layout($bind, $description, $item, $items, $parameters);
        $result = $layout->jsonSerialize();

        $this->assertSame($bind, $result['bind']);
        $this->assertSame($description, $result['description']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
        $this->assertSame($parameters, $result['parameters']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $layout = new Layout();
        $result = $layout->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('bind', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('parameters', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $description = 'Partial layout';
        $item = $this->createMock(APLBaseComponent::class);

        $layout = new Layout(null, $description, $item);
        $result = $layout->jsonSerialize();

        $this->assertSame($description, $result['description']);
        $this->assertSame($item, $result['item']);
        $this->assertArrayNotHasKey('bind', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('parameters', $result);
    }

    public function testJsonSerializeWithOnlyBind(): void
    {
        $bind = [$this->createMock(Bind::class)];
        $layout = new Layout($bind);
        $result = $layout->jsonSerialize();

        $this->assertSame($bind, $result['bind']);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('parameters', $result);
    }

    public function testJsonSerializeWithOnlyItems(): void
    {
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];
        $layout = new Layout(null, null, null, $items);
        $result = $layout->jsonSerialize();

        $this->assertSame($items, $result['items']);
        $this->assertArrayNotHasKey('bind', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('parameters', $result);
    }

    public function testJsonSerializeWithOnlyParameters(): void
    {
        $parameters = [
            $this->createMock(LayoutParameter::class),
            $this->createMock(LayoutParameter::class),
        ];
        $layout = new Layout(null, null, null, null, $parameters);
        $result = $layout->jsonSerialize();

        $this->assertSame($parameters, $result['parameters']);
        $this->assertArrayNotHasKey('bind', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeFiltersNullValues(): void
    {
        $layout = new Layout(null, 'description', null, null, null);
        $result = $layout->jsonSerialize();

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertSame('description', $result['description']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $layout = new Layout();

        $this->assertInstanceOf(\JsonSerializable::class, $layout);
    }
}
