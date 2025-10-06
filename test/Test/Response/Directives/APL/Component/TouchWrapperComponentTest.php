<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\TouchWrapperComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use PHPUnit\Framework\TestCase;

class TouchWrapperComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $item = $this->createMock(APLBaseComponent::class);
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];

        $component = new TouchWrapperComponent($item, $items);

        $this->assertSame($item, $component->item);
        $this->assertSame($items, $component->items);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new TouchWrapperComponent();

        $this->assertNull($component->item);
        $this->assertNull($component->items);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $item = $this->createMock(APLBaseComponent::class);
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];

        $component = new TouchWrapperComponent($item, $items);
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::TOUCH_WRAPPER->value, $result['type']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
    }

    public function testJsonSerializeWithOnlyItem(): void
    {
        $item = $this->createMock(APLBaseComponent::class);
        $component = new TouchWrapperComponent($item);
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::TOUCH_WRAPPER->value, $result['type']);
        $this->assertSame($item, $result['item']);
        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithOnlyItems(): void
    {
        $items = [$this->createMock(APLBaseComponent::class)];
        $component = new TouchWrapperComponent(null, $items);
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::TOUCH_WRAPPER->value, $result['type']);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertSame($items, $result['items']);
    }

    public function testJsonSerializeWithEmptyItems(): void
    {
        $component = new TouchWrapperComponent(null, []);
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new TouchWrapperComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::TOUCH_WRAPPER->value, $result['type']);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::TOUCH_WRAPPER, TouchWrapperComponent::TYPE);
    }

    public function testExtendsTouchableComponent(): void
    {
        $component = new TouchWrapperComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\TouchableComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new TouchWrapperComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
