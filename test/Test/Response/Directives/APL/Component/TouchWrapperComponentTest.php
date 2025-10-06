<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\TouchableComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\TouchWrapperComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
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

        $this->assertInstanceOf(TouchableComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new TouchWrapperComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }

    public function testJsonSerializeIncludesTouchableProperties(): void
    {
        $component = new TouchWrapperComponent();

        // Candidate event / gesture properties typically exposed by a touchable component.
        $candidateEventProps = [
            'onPress', 'onLongPress', 'onDown', 'onUp', 'onCancel', 'onMove',
            'onFocus', 'onBlur', 'gestures', 'onSwipe', 'onScroll',
        ];

        $expected = [];

        foreach ($candidateEventProps as $prop) {
            if (property_exists($component, $prop)) {
                // For command arrays supply one mock command; for gestures supply a simple array element.
                if (str_starts_with($prop, 'on')) {
                    $expected[$prop] = [$this->createMock(AbstractStandardCommand::class)];
                } elseif ($prop === 'gestures') {
                    $expected[$prop] = [['type' => 'testGesture']];
                } else {
                    $expected[$prop] = ['value'];
                }
                $component->$prop = $expected[$prop];
            }
        }

        $json = $component->jsonSerialize();

        // Base type assertion still valid.
        $this->assertSame(APLComponentType::TOUCH_WRAPPER->value, $json['type']);

        // Verify every property we actually set (and that exists) was serialized.
        foreach ($expected as $prop => $value) {
            $this->assertArrayHasKey($prop, $json, "Property '$prop' not serialized.");
            $this->assertSame($value, $json[$prop], "Serialized value mismatch for '$prop'.");
        }
    }
}
