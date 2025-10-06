<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\ContainerComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AlignItems;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Direction;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\JustifyContent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Wrap;
use PHPUnit\Framework\TestCase;

class ContainerComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $alignItems = AlignItems::CENTER;
        $direction = Direction::ROW;
        $justifyContent = JustifyContent::SPACE_BETWEEN;
        $numbered = true;
        $wrap = Wrap::WRAP;

        $component = new ContainerComponent($alignItems, $direction, $justifyContent, $numbered, $wrap);

        $this->assertSame($alignItems, $component->alignItems);
        $this->assertSame($direction, $component->direction);
        $this->assertSame($justifyContent, $component->justifyContent);
        $this->assertTrue($component->numbered);
        $this->assertSame($wrap, $component->wrap);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new ContainerComponent();

        $this->assertNull($component->alignItems);
        $this->assertNull($component->direction);
        $this->assertNull($component->justifyContent);
        $this->assertFalse($component->numbered);
        $this->assertNull($component->wrap);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $alignItems = AlignItems::START;
        $direction = Direction::COLUMN;
        $justifyContent = JustifyContent::CENTER;
        $wrap = Wrap::NO_WRAP;

        $component = new ContainerComponent($alignItems, $direction, $justifyContent, true, $wrap);
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::CONTAINER->value, $result['type']);
        $this->assertSame($alignItems->value, $result['alignItems']);
        $this->assertSame($direction->value, $result['direction']);
        $this->assertSame($justifyContent->value, $result['justifyContent']);
        $this->assertTrue($result['numbered']);
        $this->assertSame($wrap->value, $result['wrap']);
    }

    public function testJsonSerializeWithDefaultNumbered(): void
    {
        $component = new ContainerComponent();
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('numbered', $result);
    }

    public function testJsonSerializeWithNumberedTrue(): void
    {
        $component = new ContainerComponent(numbered: true);
        $result = $component->jsonSerialize();

        $this->assertTrue($result['numbered']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new ContainerComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::CONTAINER->value, $result['type']);
        $this->assertArrayNotHasKey('alignItems', $result);
        $this->assertArrayNotHasKey('direction', $result);
        $this->assertArrayNotHasKey('justifyContent', $result);
        $this->assertArrayNotHasKey('wrap', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::CONTAINER, ContainerComponent::TYPE);
    }

    public function testExtendsMultiChildComponent(): void
    {
        $component = new ContainerComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\MultiChildComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new ContainerComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
