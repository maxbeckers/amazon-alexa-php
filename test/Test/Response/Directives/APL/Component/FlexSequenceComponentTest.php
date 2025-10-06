<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Request\ScrollDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\FlexSequenceComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FlexAlignItems;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Snap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class FlexSequenceComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $alignItems = FlexAlignItems::CENTER;
        $numbered = true;
        $onScroll = [$this->createMock(AbstractStandardCommand::class)];
        $scrollDirection = ScrollDirection::VERTICAL;
        $snap = Snap::START;

        $component = new FlexSequenceComponent($alignItems, $numbered, $onScroll, $scrollDirection, $snap);

        $this->assertSame($alignItems, $component->alignItems);
        $this->assertTrue($component->numbered);
        $this->assertSame($onScroll, $component->onScroll);
        $this->assertSame($scrollDirection, $component->scrollDirection);
        $this->assertSame($snap, $component->snap);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new FlexSequenceComponent();

        $this->assertNull($component->alignItems);
        $this->assertFalse($component->numbered);
        $this->assertNull($component->onScroll);
        $this->assertNull($component->scrollDirection);
        $this->assertNull($component->snap);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $alignItems = FlexAlignItems::END;
        $onScroll = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $scrollDirection = ScrollDirection::HORIZONTAL;
        $snap = Snap::CENTER;

        $component = new FlexSequenceComponent($alignItems, true, $onScroll, $scrollDirection, $snap);
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::FLEX_SEQUENCE->value, $result['type']);
        $this->assertSame($alignItems->value, $result['alignItems']);
        $this->assertTrue($result['numbered']);
        $this->assertSame($onScroll, $result['onScroll']);
        $this->assertSame($scrollDirection->value, $result['scrollDirection']);
        $this->assertSame($snap->value, $result['snap']);
    }

    public function testJsonSerializeWithDefaultNumbered(): void
    {
        $component = new FlexSequenceComponent();
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('numbered', $result);
    }

    public function testJsonSerializeWithNumberedTrue(): void
    {
        $component = new FlexSequenceComponent(numbered: true);
        $result = $component->jsonSerialize();

        $this->assertTrue($result['numbered']);
    }

    public function testJsonSerializeWithEmptyOnScroll(): void
    {
        $component = new FlexSequenceComponent(onScroll: []);
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('onScroll', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new FlexSequenceComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::FLEX_SEQUENCE->value, $result['type']);
        $this->assertArrayNotHasKey('alignItems', $result);
        $this->assertArrayNotHasKey('onScroll', $result);
        $this->assertArrayNotHasKey('scrollDirection', $result);
        $this->assertArrayNotHasKey('snap', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::FLEX_SEQUENCE, FlexSequenceComponent::TYPE);
    }

    public function testExtendsAPLBaseComponent(): void
    {
        $component = new FlexSequenceComponent();

        $this->assertInstanceOf(APLBaseComponent::class, $component);
    }

    public function testUsesActionableComponentTrait(): void
    {
        $component = new FlexSequenceComponent();

        $this->assertTrue(in_array(
            ActionableComponentTrait::class,
            class_uses($component),
            true
        ));
    }

    public function testUsesMultiChildComponentTrait(): void
    {
        $component = new FlexSequenceComponent();

        $this->assertTrue(in_array(
            MultiChildComponentTrait::class,
            class_uses($component),
            true
        ));
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new FlexSequenceComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
