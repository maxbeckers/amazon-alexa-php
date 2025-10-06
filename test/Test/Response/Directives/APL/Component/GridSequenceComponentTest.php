<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Request\ScrollDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\GridSequenceComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Snap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class GridSequenceComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $childHeight = '100dp';
        $childHeights = ['100dp', '200dp'];
        $childWidth = '150dp';
        $childWidths = ['150dp', '250dp'];
        $numbered = true;
        $onScroll = [$this->createMock(AbstractStandardCommand::class)];
        $preserve = ['scrollPosition'];
        $scrollDirection = ScrollDirection::HORIZONTAL;
        $snap = Snap::CENTER;

        $component = new GridSequenceComponent(
            $childHeight,
            $childHeights,
            $childWidth,
            $childWidths,
            $numbered,
            $onScroll,
            $preserve,
            $scrollDirection,
            $snap
        );

        $this->assertSame($childHeight, $component->childHeight);
        $this->assertSame($childHeights, $component->childHeights);
        $this->assertSame($childWidth, $component->childWidth);
        $this->assertSame($childWidths, $component->childWidths);
        $this->assertTrue($component->numbered);
        $this->assertSame($onScroll, $component->onScroll);
        $this->assertSame($preserve, $component->preserve);
        $this->assertSame($scrollDirection, $component->scrollDirection);
        $this->assertSame($snap, $component->snap);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new GridSequenceComponent();

        $this->assertNull($component->childHeight);
        $this->assertNull($component->childHeights);
        $this->assertNull($component->childWidth);
        $this->assertNull($component->childWidths);
        $this->assertFalse($component->numbered);
        $this->assertNull($component->onScroll);
        $this->assertNull($component->preserve);
        $this->assertNull($component->scrollDirection);
        $this->assertNull($component->snap);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $childHeight = '80dp';
        $childHeights = ['80dp', '120dp'];
        $childWidth = '100dp';
        $childWidths = ['100dp', '200dp'];
        $onScroll = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $preserve = ['state', 'position'];
        $scrollDirection = ScrollDirection::VERTICAL;
        $snap = Snap::START;

        $component = new GridSequenceComponent(
            $childHeight,
            $childHeights,
            $childWidth,
            $childWidths,
            true,
            $onScroll,
            $preserve,
            $scrollDirection,
            $snap
        );

        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::GRID_SEQUENCE->value, $result['type']);
        $this->assertSame($childHeight, $result['childHeight']);
        $this->assertSame($childHeights, $result['childHeights']);
        $this->assertSame($childWidth, $result['childWidth']);
        $this->assertSame($childWidths, $result['childWidths']);
        $this->assertTrue($result['numbered']);
        $this->assertSame($onScroll, $result['onScroll']);
        $this->assertSame($preserve, $result['preserve']);
        $this->assertSame($scrollDirection->value, $result['scrollDirection']);
        $this->assertSame($snap->value, $result['snap']);
    }

    public function testJsonSerializeWithDefaultNumbered(): void
    {
        $component = new GridSequenceComponent();
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('numbered', $result);
    }

    public function testJsonSerializeWithNumberedTrue(): void
    {
        $component = new GridSequenceComponent(numbered: true);
        $result = $component->jsonSerialize();

        $this->assertTrue($result['numbered']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $component = new GridSequenceComponent(
            childHeights: [],
            childWidths: [],
            onScroll: [],
            preserve: []
        );
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('childHeights', $result);
        $this->assertArrayNotHasKey('childWidths', $result);
        $this->assertArrayNotHasKey('onScroll', $result);
        $this->assertArrayNotHasKey('preserve', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new GridSequenceComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::GRID_SEQUENCE->value, $result['type']);
        $this->assertArrayNotHasKey('childHeight', $result);
        $this->assertArrayNotHasKey('childHeights', $result);
        $this->assertArrayNotHasKey('childWidth', $result);
        $this->assertArrayNotHasKey('childWidths', $result);
        $this->assertArrayNotHasKey('onScroll', $result);
        $this->assertArrayNotHasKey('preserve', $result);
        $this->assertArrayNotHasKey('scrollDirection', $result);
        $this->assertArrayNotHasKey('snap', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::GRID_SEQUENCE, GridSequenceComponent::TYPE);
    }

    public function testExtendsAPLBaseComponent(): void
    {
        $component = new GridSequenceComponent();

        $this->assertInstanceOf(APLBaseComponent::class, $component);
    }

    public function testUsesActionableComponentTrait(): void
    {
        $component = new GridSequenceComponent();

        $this->assertTrue(in_array(
            ActionableComponentTrait::class,
            class_uses($component),
            true
        ));
    }

    public function testUsesMultiChildComponentTrait(): void
    {
        $component = new GridSequenceComponent();

        $this->assertTrue(in_array(
            MultiChildComponentTrait::class,
            class_uses($component),
            true
        ));
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new GridSequenceComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
