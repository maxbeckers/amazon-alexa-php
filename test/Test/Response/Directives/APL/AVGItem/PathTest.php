<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\AVGItem;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\Path;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StrokeLineCap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StrokeLineJoin;
use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $fill = '#ff0000';
        $fillOpacity = 80;
        $fillTransform = 'scale(1.5)';
        $pathData = 'M10,10 L20,20';
        $pathLength = 100;
        $stroke = '#0000ff';
        $strokeDashArray = [5, 10, 15];
        $strokeDashOffset = 2;
        $strokeLineCap = StrokeLineCap::ROUND;
        $strokeLineJoin = StrokeLineJoin::BEVEL;
        $strokeMiterLimit = 4;
        $strokeOpacity = 90;
        $strokeTransform = 'rotate(45)';
        $strokeWidth = 3;

        $path = new Path(
            $fill,
            $fillOpacity,
            $fillTransform,
            $pathData,
            $pathLength,
            $stroke,
            $strokeDashArray,
            $strokeDashOffset,
            $strokeLineCap,
            $strokeLineJoin,
            $strokeMiterLimit,
            $strokeOpacity,
            $strokeTransform,
            $strokeWidth
        );

        $this->assertSame($fill, $path->fill);
        $this->assertSame($fillOpacity, $path->fillOpacity);
        $this->assertSame($fillTransform, $path->fillTransform);
        $this->assertSame($pathData, $path->pathData);
        $this->assertSame($pathLength, $path->pathLength);
        $this->assertSame($stroke, $path->stroke);
        $this->assertSame($strokeDashArray, $path->strokeDashArray);
        $this->assertSame($strokeDashOffset, $path->strokeDashOffset);
        $this->assertSame($strokeLineCap, $path->strokeLineCap);
        $this->assertSame($strokeLineJoin, $path->strokeLineJoin);
        $this->assertSame($strokeMiterLimit, $path->strokeMiterLimit);
        $this->assertSame($strokeOpacity, $path->strokeOpacity);
        $this->assertSame($strokeTransform, $path->strokeTransform);
        $this->assertSame($strokeWidth, $path->strokeWidth);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $path = new Path();

        $this->assertNull($path->fill);
        $this->assertNull($path->fillOpacity);
        $this->assertNull($path->fillTransform);
        $this->assertNull($path->pathData);
        $this->assertNull($path->pathLength);
        $this->assertNull($path->stroke);
        $this->assertNull($path->strokeDashArray);
        $this->assertNull($path->strokeDashOffset);
        $this->assertNull($path->strokeLineCap);
        $this->assertNull($path->strokeLineJoin);
        $this->assertNull($path->strokeMiterLimit);
        $this->assertNull($path->strokeOpacity);
        $this->assertNull($path->strokeTransform);
        $this->assertNull($path->strokeWidth);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $path = new Path(
            fill: '#green',
            fillOpacity: 70,
            fillTransform: 'translate(5, 10)',
            pathData: 'M0,0 L100,100 Z',
            pathLength: 200,
            stroke: '#blue',
            strokeDashArray: [3, 6, 9],
            strokeDashOffset: 1,
            strokeLineCap: StrokeLineCap::SQUARE,
            strokeLineJoin: StrokeLineJoin::MITER,
            strokeMiterLimit: 8,
            strokeOpacity: 85,
            strokeTransform: 'skewX(30)',
            strokeWidth: 2
        );

        $result = $path->jsonSerialize();

        $this->assertSame(AVGItemType::PATH->value, $result['type']);
        $this->assertSame('#green', $result['fill']);
        $this->assertSame(70, $result['fillOpacity']);
        $this->assertSame('translate(5, 10)', $result['fillTransform']);
        $this->assertSame('M0,0 L100,100 Z', $result['pathData']);
        $this->assertSame(200, $result['pathLength']);
        $this->assertSame('#blue', $result['stroke']);
        $this->assertSame([3, 6, 9], $result['strokeDashArray']);
        $this->assertSame(1, $result['strokeDashOffset']);
        $this->assertSame(StrokeLineCap::SQUARE->value, $result['strokeLineCap']);
        $this->assertSame(StrokeLineJoin::MITER->value, $result['strokeLineJoin']);
        $this->assertSame(8, $result['strokeMiterLimit']);
        $this->assertSame(85, $result['strokeOpacity']);
        $this->assertSame('skewX(30)', $result['strokeTransform']);
        $this->assertSame(2, $result['strokeWidth']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $path = new Path();
        $result = $path->jsonSerialize();

        $this->assertSame(AVGItemType::PATH->value, $result['type']);
        $this->assertArrayNotHasKey('fill', $result);
        $this->assertArrayNotHasKey('fillOpacity', $result);
        $this->assertArrayNotHasKey('fillTransform', $result);
        $this->assertArrayNotHasKey('pathData', $result);
        $this->assertArrayNotHasKey('pathLength', $result);
        $this->assertArrayNotHasKey('stroke', $result);
        $this->assertArrayNotHasKey('strokeDashArray', $result);
        $this->assertArrayNotHasKey('strokeDashOffset', $result);
        $this->assertArrayNotHasKey('strokeLineCap', $result);
        $this->assertArrayNotHasKey('strokeLineJoin', $result);
        $this->assertArrayNotHasKey('strokeMiterLimit', $result);
        $this->assertArrayNotHasKey('strokeOpacity', $result);
        $this->assertArrayNotHasKey('strokeTransform', $result);
        $this->assertArrayNotHasKey('strokeWidth', $result);
    }

    public function testJsonSerializeWithEmptyStrokeDashArray(): void
    {
        $path = new Path(strokeDashArray: []);
        $result = $path->jsonSerialize();

        $this->assertArrayNotHasKey('strokeDashArray', $result);
    }

    public function testJsonSerializeWithStrokeLineCapValues(): void
    {
        $lineCapValues = [StrokeLineCap::BUTT, StrokeLineCap::ROUND, StrokeLineCap::SQUARE];

        foreach ($lineCapValues as $lineCap) {
            $path = new Path(strokeLineCap: $lineCap);
            $result = $path->jsonSerialize();

            $this->assertSame($lineCap->value, $result['strokeLineCap']);
        }
    }

    public function testJsonSerializeWithStrokeLineJoinValues(): void
    {
        $lineJoinValues = [StrokeLineJoin::MITER, StrokeLineJoin::ROUND, StrokeLineJoin::BEVEL];

        foreach ($lineJoinValues as $lineJoin) {
            $path = new Path(strokeLineJoin: $lineJoin);
            $result = $path->jsonSerialize();

            $this->assertSame($lineJoin->value, $result['strokeLineJoin']);
        }
    }

    public function testJsonSerializeWithZeroValues(): void
    {
        $path = new Path(
            fillOpacity: 0,
            pathLength: 0,
            strokeDashOffset: 0,
            strokeMiterLimit: 0,
            strokeOpacity: 0,
            strokeWidth: 0
        );
        $result = $path->jsonSerialize();

        $this->assertSame(0, $result['fillOpacity']);
        $this->assertSame(0, $result['pathLength']);
        $this->assertSame(0, $result['strokeDashOffset']);
        $this->assertSame(0, $result['strokeMiterLimit']);
        $this->assertSame(0, $result['strokeOpacity']);
        $this->assertSame(0, $result['strokeWidth']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(AVGItemType::PATH, Path::TYPE);
    }

    public function testExtendsAVGItem(): void
    {
        $path = new Path();

        $this->assertInstanceOf(AVGItem::class, $path);
    }

    public function testImplementsJsonSerializable(): void
    {
        $path = new Path();

        $this->assertInstanceOf(\JsonSerializable::class, $path);
    }
}
