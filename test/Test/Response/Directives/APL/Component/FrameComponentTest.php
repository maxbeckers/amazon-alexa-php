<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\FrameComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Gradient;
use PHPUnit\Framework\TestCase;

class FrameComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $background = '#ffffff';
        $backgroundColor = '#000000';
        $borderColor = '#ff0000';
        $borderRadius = '10px';
        $borderWidth = '2px';
        $item = $this->createMock(APLBaseComponent::class);
        $items = [$this->createMock(APLBaseComponent::class)];

        $component = new FrameComponent(
            $background,
            $backgroundColor,
            null,
            null,
            $borderColor,
            $borderRadius,
            null,
            null,
            null,
            $borderWidth,
            $item,
            $items
        );

        $this->assertSame($background, $component->background);
        $this->assertSame($backgroundColor, $component->backgroundColor);
        $this->assertSame($borderColor, $component->borderColor);
        $this->assertSame($borderRadius, $component->borderRadius);
        $this->assertSame($borderWidth, $component->borderWidth);
        $this->assertSame($item, $component->item);
        $this->assertSame($items, $component->items);
    }

    public function testConstructorWithGradientBackground(): void
    {
        $gradient = $this->createMock(Gradient::class);

        $component = new FrameComponent(background: $gradient);

        $this->assertSame($gradient, $component->background);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new FrameComponent();

        $this->assertNull($component->background);
        $this->assertNull($component->backgroundColor);
        $this->assertSame('0', $component->borderRadius);
        $this->assertSame('0', $component->borderWidth);
        $this->assertNull($component->item);
        $this->assertNull($component->items);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $background = '#blue';
        $backgroundColor = '#red';
        $borderBottomLeftRadius = '5px';
        $borderTopRightRadius = '8px';
        $borderColor = '#green';
        $borderStrokeWidth = '1px';
        $item = $this->createMock(APLBaseComponent::class);

        $component = new FrameComponent(
            background: $background,
            backgroundColor: $backgroundColor,
            borderBottomLeftRadius: $borderBottomLeftRadius,
            borderTopRightRadius: $borderTopRightRadius,
            borderColor: $borderColor,
            borderRadius: '10px',
            borderStrokeWidth: $borderStrokeWidth,
            borderWidth: '2px',
            item: $item
        );

        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::FRAME->value, $result['type']);
        $this->assertSame($background, $result['background']);
        $this->assertSame($backgroundColor, $result['backgroundColor']);
        $this->assertSame($borderBottomLeftRadius, $result['borderBottomLeftRadius']);
        $this->assertSame($borderTopRightRadius, $result['borderTopRightRadius']);
        $this->assertSame($borderColor, $result['borderColor']);
        $this->assertSame('10px', $result['borderRadius']);
        $this->assertSame($borderStrokeWidth, $result['borderStrokeWidth']);
        $this->assertSame('2px', $result['borderWidth']);
        $this->assertSame($item, $result['item']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $component = new FrameComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::FRAME->value, $result['type']);
        $this->assertArrayNotHasKey('borderRadius', $result);
        $this->assertArrayNotHasKey('borderWidth', $result);
    }

    public function testJsonSerializeWithNonDefaultBorderValues(): void
    {
        $component = new FrameComponent(borderRadius: '5px', borderWidth: '1px');
        $result = $component->jsonSerialize();

        $this->assertSame('5px', $result['borderRadius']);
        $this->assertSame('1px', $result['borderWidth']);
    }

    public function testJsonSerializeWithEmptyItems(): void
    {
        $component = new FrameComponent(items: []);
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithItems(): void
    {
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];

        $component = new FrameComponent(items: $items);
        $result = $component->jsonSerialize();

        $this->assertSame($items, $result['items']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::FRAME, FrameComponent::TYPE);
    }

    public function testExtendsAPLBaseComponent(): void
    {
        $component = new FrameComponent();

        $this->assertInstanceOf(APLBaseComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new FrameComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
