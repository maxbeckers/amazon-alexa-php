<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\PagerComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Navigation;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\PageDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class PagerComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $handlePageMove = ['handler1', 'handler2'];
        $initialPage = 2;
        $navigation = Navigation::NORMAL;
        $onPageChanged = [$this->createMock(AbstractStandardCommand::class)];
        $pageDirection = PageDirection::HORIZONTAL;
        $preserve = ['pageIndex', 'state'];

        $component = new PagerComponent(
            $handlePageMove,
            $initialPage,
            $navigation,
            $onPageChanged,
            $pageDirection,
            $preserve
        );

        $this->assertSame($handlePageMove, $component->handlePageMove);
        $this->assertSame($initialPage, $component->initialPage);
        $this->assertSame($navigation, $component->navigation);
        $this->assertSame($onPageChanged, $component->onPageChanged);
        $this->assertSame($pageDirection, $component->pageDirection);
        $this->assertSame($preserve, $component->preserve);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new PagerComponent();

        $this->assertNull($component->handlePageMove);
        $this->assertSame(0, $component->initialPage);
        $this->assertNull($component->navigation);
        $this->assertNull($component->onPageChanged);
        $this->assertNull($component->pageDirection);
        $this->assertNull($component->preserve);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $handlePageMove = ['moveHandler1', 'moveHandler2'];
        $initialPage = 1;
        $navigation = Navigation::WRAP;
        $onPageChanged = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $pageDirection = PageDirection::VERTICAL;
        $preserve = ['position', 'scroll'];

        $component = new PagerComponent(
            $handlePageMove,
            $initialPage,
            $navigation,
            $onPageChanged,
            $pageDirection,
            $preserve
        );

        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::PAGER->value, $result['type']);
        $this->assertSame($handlePageMove, $result['handlePageMove']);
        $this->assertSame($initialPage, $result['initialPage']);
        $this->assertSame($navigation->value, $result['navigation']);
        $this->assertSame($onPageChanged, $result['onPageChanged']);
        $this->assertSame($pageDirection->value, $result['pageDirection']);
        $this->assertSame($preserve, $result['preserve']);
    }

    public function testJsonSerializeWithDefaultInitialPage(): void
    {
        $component = new PagerComponent();
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('initialPage', $result);
    }

    public function testJsonSerializeWithNonZeroInitialPage(): void
    {
        $component = new PagerComponent(initialPage: 3);
        $result = $component->jsonSerialize();

        $this->assertSame(3, $result['initialPage']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $component = new PagerComponent(
            handlePageMove: [],
            onPageChanged: [],
            preserve: []
        );
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('handlePageMove', $result);
        $this->assertArrayNotHasKey('onPageChanged', $result);
        $this->assertArrayNotHasKey('preserve', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new PagerComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::PAGER->value, $result['type']);
        $this->assertArrayNotHasKey('handlePageMove', $result);
        $this->assertArrayNotHasKey('navigation', $result);
        $this->assertArrayNotHasKey('onPageChanged', $result);
        $this->assertArrayNotHasKey('pageDirection', $result);
        $this->assertArrayNotHasKey('preserve', $result);
    }

    public function testJsonSerializeWithDifferentNavigationValues(): void
    {
        $navigationValues = [Navigation::NORMAL, Navigation::NONE, Navigation::WRAP];

        foreach ($navigationValues as $navigation) {
            $component = new PagerComponent(navigation: $navigation);
            $result = $component->jsonSerialize();

            $this->assertSame($navigation->value, $result['navigation']);
        }
    }

    public function testJsonSerializeWithDifferentPageDirections(): void
    {
        $pageDirections = [PageDirection::HORIZONTAL, PageDirection::VERTICAL];

        foreach ($pageDirections as $direction) {
            $component = new PagerComponent(pageDirection: $direction);
            $result = $component->jsonSerialize();

            $this->assertSame($direction->value, $result['pageDirection']);
        }
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::PAGER, PagerComponent::TYPE);
    }

    public function testExtendsAPLBaseComponent(): void
    {
        $component = new PagerComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent::class, $component);
    }

    public function testUsesActionableComponentTrait(): void
    {
        $component = new PagerComponent();

        $this->assertTrue(in_array(
            \MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait::class,
            class_uses($component),
            true
        ));
    }

    public function testUsesMultiChildComponentTrait(): void
    {
        $component = new PagerComponent();

        $this->assertTrue(in_array(
            \MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait::class,
            class_uses($component),
            true
        ));
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new PagerComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
