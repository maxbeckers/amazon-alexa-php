<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\ScrollViewComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class ScrollViewComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $item = $this->createMock(APLBaseComponent::class);
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];
        $preserve = ['scrollPosition', 'state'];
        $onScroll = [$this->createMock(AbstractStandardCommand::class)];

        $component = new ScrollViewComponent($item, $items, $preserve, $onScroll);

        $this->assertSame($item, $component->item);
        $this->assertSame($items, $component->items);
        $this->assertSame($preserve, $component->preserve);
        $this->assertSame($onScroll, $component->onScroll);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new ScrollViewComponent();

        $this->assertNull($component->item);
        $this->assertNull($component->items);
        $this->assertNull($component->preserve);
        $this->assertNull($component->onScroll);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $item = $this->createMock(APLBaseComponent::class);
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];
        $preserve = ['position', 'scroll'];
        $onScroll = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];

        $component = new ScrollViewComponent($item, $items, $preserve, $onScroll);
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::SCROLL_VIEW->value, $result['type']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
        $this->assertSame($preserve, $result['preserve']);
        $this->assertSame($onScroll, $result['onScroll']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new ScrollViewComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::SCROLL_VIEW->value, $result['type']);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('preserve', $result);
        $this->assertArrayNotHasKey('onScroll', $result);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $component = new ScrollViewComponent(null, [], [], []);
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('preserve', $result);
        $this->assertArrayNotHasKey('onScroll', $result);
    }

    public function testJsonSerializeWithOnlyItem(): void
    {
        $item = $this->createMock(APLBaseComponent::class);
        $component = new ScrollViewComponent($item);
        $result = $component->jsonSerialize();

        $this->assertSame($item, $result['item']);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('preserve', $result);
        $this->assertArrayNotHasKey('onScroll', $result);
    }

    public function testJsonSerializeWithOnlyItems(): void
    {
        $items = [$this->createMock(APLBaseComponent::class)];
        $component = new ScrollViewComponent(null, $items);
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('item', $result);
        $this->assertSame($items, $result['items']);
        $this->assertArrayNotHasKey('preserve', $result);
        $this->assertArrayNotHasKey('onScroll', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::SCROLL_VIEW, ScrollViewComponent::TYPE);
    }

    public function testExtendsActionableComponent(): void
    {
        $component = new ScrollViewComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\ActionableComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new ScrollViewComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
