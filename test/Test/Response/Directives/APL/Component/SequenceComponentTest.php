<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Request\ScrollDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\SequenceComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Snap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class SequenceComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $numbered = true;
        $onScroll = [$this->createMock(AbstractStandardCommand::class)];
        $preserve = ['scrollPosition', 'state'];
        $scrollDirection = ScrollDirection::HORIZONTAL;
        $snap = Snap::CENTER;

        $component = new SequenceComponent($numbered, $onScroll, $preserve, $scrollDirection, $snap);

        $this->assertTrue($component->numbered);
        $this->assertSame($onScroll, $component->onScroll);
        $this->assertSame($preserve, $component->preserve);
        $this->assertSame($scrollDirection, $component->scrollDirection);
        $this->assertSame($snap, $component->snap);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new SequenceComponent();

        $this->assertFalse($component->numbered);
        $this->assertNull($component->onScroll);
        $this->assertNull($component->preserve);
        $this->assertNull($component->scrollDirection);
        $this->assertNull($component->snap);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $onScroll = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $preserve = ['position', 'data'];
        $scrollDirection = ScrollDirection::VERTICAL;
        $snap = Snap::START;

        $component = new SequenceComponent(true, $onScroll, $preserve, $scrollDirection, $snap);
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::SEQUENCE->value, $result['type']);
        $this->assertTrue($result['numbered']);
        $this->assertSame($onScroll, $result['onScroll']);
        $this->assertSame($preserve, $result['preserve']);
        $this->assertSame($scrollDirection->value, $result['scrollDirection']);
        $this->assertSame($snap->value, $result['snap']);
    }

    public function testJsonSerializeWithDefaultNumbered(): void
    {
        $component = new SequenceComponent();
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('numbered', $result);
    }

    public function testJsonSerializeWithNumberedTrue(): void
    {
        $component = new SequenceComponent(true);
        $result = $component->jsonSerialize();

        $this->assertTrue($result['numbered']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $component = new SequenceComponent(false, [], []);
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('onScroll', $result);
        $this->assertArrayNotHasKey('preserve', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new SequenceComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::SEQUENCE->value, $result['type']);
        $this->assertArrayNotHasKey('onScroll', $result);
        $this->assertArrayNotHasKey('preserve', $result);
        $this->assertArrayNotHasKey('scrollDirection', $result);
        $this->assertArrayNotHasKey('snap', $result);
    }

    public function testJsonSerializeWithDifferentScrollDirections(): void
    {
        $directions = [ScrollDirection::HORIZONTAL, ScrollDirection::VERTICAL];

        foreach ($directions as $direction) {
            $component = new SequenceComponent(scrollDirection: $direction);
            $result = $component->jsonSerialize();

            $this->assertSame($direction->value, $result['scrollDirection']);
        }
    }

    public function testJsonSerializeWithDifferentSnapValues(): void
    {
        $snapValues = [Snap::START, Snap::CENTER, Snap::END, Snap::FORCE_CENTER];

        foreach ($snapValues as $snap) {
            $component = new SequenceComponent(snap: $snap);
            $result = $component->jsonSerialize();

            $this->assertSame($snap->value, $result['snap']);
        }
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::SEQUENCE, SequenceComponent::TYPE);
    }

    public function testExtendsAPLBaseComponent(): void
    {
        $component = new SequenceComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent::class, $component);
    }

    public function testUsesActionableComponentTrait(): void
    {
        $component = new SequenceComponent();

        $this->assertTrue(in_array(
            \MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait::class,
            class_uses($component),
            true
        ));
    }

    public function testUsesMultiChildComponentTrait(): void
    {
        $component = new SequenceComponent();

        $this->assertTrue(in_array(
            \MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait::class,
            class_uses($component),
            true
        ));
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new SequenceComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
