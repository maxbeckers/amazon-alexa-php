<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\ImageComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ImageAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Scale;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class ImageComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $align = ImageAlign::CENTER;
        $borderRadius = '10px';
        $filter = ['type' => 'blur', 'value' => 5];
        $filters = [['type' => 'brightness', 'value' => 1.2]];
        $onFail = [$this->createMock(AbstractStandardCommand::class)];
        $onLoad = [$this->createMock(AbstractStandardCommand::class)];
        $overlayColor = '#ff0000';
        $overlayGradient = ['type' => 'linear'];
        $scale = Scale::FILL;
        $source = 'https://example.com/image.jpg';
        $sources = ['https://example.com/image1.jpg', 'https://example.com/image2.jpg'];

        $component = new ImageComponent(
            $align,
            $borderRadius,
            $filter,
            $filters,
            $onFail,
            $onLoad,
            $overlayColor,
            $overlayGradient,
            $scale,
            $source,
            $sources
        );

        $this->assertSame($align, $component->align);
        $this->assertSame($borderRadius, $component->borderRadius);
        $this->assertSame($filter, $component->filter);
        $this->assertSame($filters, $component->filters);
        $this->assertSame($onFail, $component->onFail);
        $this->assertSame($onLoad, $component->onLoad);
        $this->assertSame($overlayColor, $component->overlayColor);
        $this->assertSame($overlayGradient, $component->overlayGradient);
        $this->assertSame($scale, $component->scale);
        $this->assertSame($source, $component->source);
        $this->assertSame($sources, $component->sources);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new ImageComponent();

        $this->assertNull($component->align);
        $this->assertSame('0', $component->borderRadius);
        $this->assertNull($component->filter);
        $this->assertNull($component->filters);
        $this->assertNull($component->onFail);
        $this->assertNull($component->onLoad);
        $this->assertSame('none', $component->overlayColor);
        $this->assertNull($component->overlayGradient);
        $this->assertNull($component->scale);
        $this->assertNull($component->source);
        $this->assertNull($component->sources);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $align = ImageAlign::TOP_LEFT;
        $filter = ['type' => 'grayscale'];
        $filters = [['type' => 'sepia'], ['type' => 'invert']];
        $onFail = [$this->createMock(AbstractStandardCommand::class)];
        $onLoad = [$this->createMock(AbstractStandardCommand::class)];
        $overlayGradient = ['angle' => 45, 'colors' => ['red', 'blue']];
        $scale = Scale::BEST_FIT;
        $source = 'https://test.com/image.png';

        $component = new ImageComponent(
            align: $align,
            borderRadius: '5px',
            filter: $filter,
            filters: $filters,
            onFail: $onFail,
            onLoad: $onLoad,
            overlayColor: '#blue',
            overlayGradient: $overlayGradient,
            scale: $scale,
            source: $source
        );

        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::IMAGE->value, $result['type']);
        $this->assertSame($align->value, $result['align']);
        $this->assertSame('5px', $result['borderRadius']);
        $this->assertSame($filter, $result['filter']);
        $this->assertSame($filters, $result['filters']);
        $this->assertSame($onFail, $result['onFail']);
        $this->assertSame($onLoad, $result['onLoad']);
        $this->assertSame('#blue', $result['overlayColor']);
        $this->assertSame($overlayGradient, $result['overlayGradient']);
        $this->assertSame($scale->value, $result['scale']);
        $this->assertSame($source, $result['source']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $component = new ImageComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::IMAGE->value, $result['type']);
        $this->assertArrayNotHasKey('borderRadius', $result);
        $this->assertArrayNotHasKey('overlayColor', $result);
    }

    public function testJsonSerializeWithNonDefaultBorderRadius(): void
    {
        $component = new ImageComponent(borderRadius: '15px');
        $result = $component->jsonSerialize();

        $this->assertSame('15px', $result['borderRadius']);
    }

    public function testJsonSerializeWithNonDefaultOverlayColor(): void
    {
        $component = new ImageComponent(overlayColor: '#green');
        $result = $component->jsonSerialize();

        $this->assertSame('#green', $result['overlayColor']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $component = new ImageComponent(
            filter: [],
            filters: [],
            onFail: [],
            onLoad: [],
            overlayGradient: [],
            sources: []
        );
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('filter', $result);
        $this->assertArrayNotHasKey('filters', $result);
        $this->assertArrayNotHasKey('onFail', $result);
        $this->assertArrayNotHasKey('onLoad', $result);
        $this->assertArrayNotHasKey('overlayGradient', $result);
        $this->assertArrayNotHasKey('sources', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new ImageComponent();
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('align', $result);
        $this->assertArrayNotHasKey('filter', $result);
        $this->assertArrayNotHasKey('filters', $result);
        $this->assertArrayNotHasKey('onFail', $result);
        $this->assertArrayNotHasKey('onLoad', $result);
        $this->assertArrayNotHasKey('overlayGradient', $result);
        $this->assertArrayNotHasKey('scale', $result);
        $this->assertArrayNotHasKey('source', $result);
        $this->assertArrayNotHasKey('sources', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::IMAGE, ImageComponent::TYPE);
    }

    public function testExtendsAPLBaseComponent(): void
    {
        $component = new ImageComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new ImageComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
