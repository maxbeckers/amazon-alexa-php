<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\AVGFilter;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGFilter\AVGFilter;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGFilter\DropShadow;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGFilterType;
use PHPUnit\Framework\TestCase;

class DropShadowTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $color = '#ff0000';
        $horizontalOffset = 5;
        $radius = 10;
        $verticalOffset = 3;

        $dropShadow = new DropShadow($color, $horizontalOffset, $radius, $verticalOffset);

        $this->assertSame($color, $dropShadow->color);
        $this->assertSame($horizontalOffset, $dropShadow->horizontalOffset);
        $this->assertSame($radius, $dropShadow->radius);
        $this->assertSame($verticalOffset, $dropShadow->verticalOffset);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $dropShadow = new DropShadow();

        $this->assertNull($dropShadow->color);
        $this->assertNull($dropShadow->horizontalOffset);
        $this->assertNull($dropShadow->radius);
        $this->assertNull($dropShadow->verticalOffset);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $color = '#0000ff';
        $horizontalOffset = 8;
        $radius = 15;
        $verticalOffset = -2;

        $dropShadow = new DropShadow($color, $horizontalOffset, $radius, $verticalOffset);
        $result = $dropShadow->jsonSerialize();

        $this->assertSame(AVGFilterType::DROP_SHADOW->value, $result['type']);
        $this->assertSame($color, $result['color']);
        $this->assertSame($horizontalOffset, $result['horizontalOffset']);
        $this->assertSame($radius, $result['radius']);
        $this->assertSame($verticalOffset, $result['verticalOffset']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $dropShadow = new DropShadow();
        $result = $dropShadow->jsonSerialize();

        $this->assertSame(AVGFilterType::DROP_SHADOW->value, $result['type']);
        $this->assertArrayNotHasKey('color', $result);
        $this->assertArrayNotHasKey('horizontalOffset', $result);
        $this->assertArrayNotHasKey('radius', $result);
        $this->assertArrayNotHasKey('verticalOffset', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $dropShadow = new DropShadow('#green', null, 20, null);
        $result = $dropShadow->jsonSerialize();

        $this->assertSame(AVGFilterType::DROP_SHADOW->value, $result['type']);
        $this->assertSame('#green', $result['color']);
        $this->assertSame(20, $result['radius']);
        $this->assertArrayNotHasKey('horizontalOffset', $result);
        $this->assertArrayNotHasKey('verticalOffset', $result);
    }

    public function testJsonSerializeWithZeroValues(): void
    {
        $dropShadow = new DropShadow('#black', 0, 0, 0);
        $result = $dropShadow->jsonSerialize();

        $this->assertSame(AVGFilterType::DROP_SHADOW->value, $result['type']);
        $this->assertSame('#black', $result['color']);
        $this->assertSame(0, $result['horizontalOffset']);
        $this->assertSame(0, $result['radius']);
        $this->assertSame(0, $result['verticalOffset']);
    }

    public function testJsonSerializeWithNegativeValues(): void
    {
        $dropShadow = new DropShadow('#gray', -5, -10, -3);
        $result = $dropShadow->jsonSerialize();

        $this->assertSame('#gray', $result['color']);
        $this->assertSame(-5, $result['horizontalOffset']);
        $this->assertSame(-10, $result['radius']);
        $this->assertSame(-3, $result['verticalOffset']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(AVGFilterType::DROP_SHADOW, DropShadow::TYPE);
    }

    public function testExtendsAVGFilter(): void
    {
        $dropShadow = new DropShadow();

        $this->assertInstanceOf(AVGFilter::class, $dropShadow);
    }

    public function testImplementsJsonSerializable(): void
    {
        $dropShadow = new DropShadow();

        $this->assertInstanceOf(\JsonSerializable::class, $dropShadow);
    }

    public function testInheritsTypeFromParent(): void
    {
        $dropShadow = new DropShadow();
        $result = $dropShadow->jsonSerialize();

        // Verify that the type is included from parent class
        $this->assertArrayHasKey('type', $result);
        $this->assertSame(AVGFilterType::DROP_SHADOW->value, $result['type']);
    }

    public function testJsonSerializeStructure(): void
    {
        $dropShadow = new DropShadow('#white', 1, 2, 3);
        $result = $dropShadow->jsonSerialize();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('color', $result);
        $this->assertArrayHasKey('horizontalOffset', $result);
        $this->assertArrayHasKey('radius', $result);
        $this->assertArrayHasKey('verticalOffset', $result);
    }

    public function testColorFormatting(): void
    {
        $testColors = ['#ff0000', 'red', 'rgb(255, 0, 0)', 'rgba(255, 0, 0, 0.5)'];

        foreach ($testColors as $color) {
            $dropShadow = new DropShadow($color);
            $result = $dropShadow->jsonSerialize();

            $this->assertSame($color, $result['color']);
        }
    }
}
