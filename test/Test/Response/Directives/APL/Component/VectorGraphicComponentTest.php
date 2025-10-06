<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\VectorGraphicComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ImageAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Scale;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class VectorGraphicComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $align = ImageAlign::CENTER;
        $onFail = [$this->createMock(AbstractStandardCommand::class)];
        $onLoad = [$this->createMock(AbstractStandardCommand::class)];
        $parameters = ['param1' => 'value1', 'param2' => 'value2'];
        $scale = Scale::FILL;
        $source = 'https://example.com/vector.svg';

        $component = new VectorGraphicComponent($align, $onFail, $onLoad, $parameters, $scale, $source);

        $this->assertSame($align, $component->align);
        $this->assertSame($onFail, $component->onFail);
        $this->assertSame($onLoad, $component->onLoad);
        $this->assertSame($parameters, $component->parameters);
        $this->assertSame($scale, $component->scale);
        $this->assertSame($source, $component->source);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new VectorGraphicComponent();

        $this->assertNull($component->align);
        $this->assertNull($component->onFail);
        $this->assertNull($component->onLoad);
        $this->assertNull($component->parameters);
        $this->assertNull($component->scale);
        $this->assertNull($component->source);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $align = ImageAlign::TOP_LEFT;
        $onFail = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $onLoad = [$this->createMock(AbstractStandardCommand::class)];
        $parameters = ['width' => 100, 'height' => 200, 'color' => 'red'];
        $scale = Scale::BEST_FIT;
        $source = 'https://test.com/graphic.svg';

        $component = new VectorGraphicComponent($align, $onFail, $onLoad, $parameters, $scale, $source);
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::VECTOR_GRAPHIC->value, $result['type']);
        $this->assertSame($align->value, $result['align']);
        $this->assertSame($onFail, $result['onFail']);
        $this->assertSame($onLoad, $result['onLoad']);
        $this->assertSame($parameters, $result['parameters']);
        $this->assertSame($scale->value, $result['scale']);
        $this->assertSame($source, $result['source']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new VectorGraphicComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::VECTOR_GRAPHIC->value, $result['type']);
        $this->assertArrayNotHasKey('align', $result);
        $this->assertArrayNotHasKey('onFail', $result);
        $this->assertArrayNotHasKey('onLoad', $result);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('scale', $result);
        $this->assertArrayNotHasKey('source', $result);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $component = new VectorGraphicComponent(
            onFail: [],
            onLoad: [],
            parameters: []
        );
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('onFail', $result);
        $this->assertArrayNotHasKey('onLoad', $result);
        $this->assertArrayNotHasKey('parameters', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $component = new VectorGraphicComponent(
            align: ImageAlign::BOTTOM_RIGHT,
            source: 'vector.svg'
        );
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::VECTOR_GRAPHIC->value, $result['type']);
        $this->assertSame(ImageAlign::BOTTOM_RIGHT->value, $result['align']);
        $this->assertSame('vector.svg', $result['source']);
        $this->assertArrayNotHasKey('onFail', $result);
        $this->assertArrayNotHasKey('onLoad', $result);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('scale', $result);
    }

    public function testJsonSerializeWithDifferentAlignValues(): void
    {
        $alignValues = [
            ImageAlign::CENTER,
            ImageAlign::TOP_LEFT,
            ImageAlign::BOTTOM_RIGHT,
        ];

        foreach ($alignValues as $align) {
            $component = new VectorGraphicComponent(align: $align);
            $result = $component->jsonSerialize();

            $this->assertSame($align->value, $result['align']);
        }
    }

    public function testJsonSerializeWithDifferentScaleValues(): void
    {
        $scaleValues = [Scale::FILL, Scale::BEST_FIT, Scale::NONE];

        foreach ($scaleValues as $scale) {
            $component = new VectorGraphicComponent(scale: $scale);
            $result = $component->jsonSerialize();

            $this->assertSame($scale->value, $result['scale']);
        }
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::VECTOR_GRAPHIC, VectorGraphicComponent::TYPE);
    }

    public function testExtendsTouchableComponent(): void
    {
        $component = new VectorGraphicComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\TouchableComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new VectorGraphicComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
