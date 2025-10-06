<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\AVGItem;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\Text;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontStyle;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontWeight;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAnchor;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $fill = '#ff0000';
        $fillOpacity = 80;
        $fillTransform = 'scale(1.2)';
        $fontFamily = 'Arial';
        $fontSize = 16;
        $fontStyle = FontStyle::ITALIC;
        $fontWeight = FontWeight::BOLD;
        $letterSpacing = 2;
        $stroke = '#0000ff';
        $strokeOpacity = 90;
        $strokeTransform = 'rotate(10)';
        $strokeWidth = 1;
        $text = 'Hello World';
        $textAnchor = TextAnchor::MIDDLE;
        $x = 100;
        $y = 200;

        $textItem = new Text(
            $fill,
            $fillOpacity,
            $fillTransform,
            $fontFamily,
            $fontSize,
            $fontStyle,
            $fontWeight,
            $letterSpacing,
            $stroke,
            $strokeOpacity,
            $strokeTransform,
            $strokeWidth,
            $text,
            $textAnchor,
            $x,
            $y
        );

        $this->assertSame($fill, $textItem->fill);
        $this->assertSame($fillOpacity, $textItem->fillOpacity);
        $this->assertSame($fillTransform, $textItem->fillTransform);
        $this->assertSame($fontFamily, $textItem->fontFamily);
        $this->assertSame($fontSize, $textItem->fontSize);
        $this->assertSame($fontStyle, $textItem->fontStyle);
        $this->assertSame($fontWeight, $textItem->fontWeight);
        $this->assertSame($letterSpacing, $textItem->letterSpacing);
        $this->assertSame($stroke, $textItem->stroke);
        $this->assertSame($strokeOpacity, $textItem->strokeOpacity);
        $this->assertSame($strokeTransform, $textItem->strokeTransform);
        $this->assertSame($strokeWidth, $textItem->strokeWidth);
        $this->assertSame($text, $textItem->text);
        $this->assertSame($textAnchor, $textItem->textAnchor);
        $this->assertSame($x, $textItem->x);
        $this->assertSame($y, $textItem->y);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $textItem = new Text();

        $this->assertNull($textItem->fill);
        $this->assertNull($textItem->fillOpacity);
        $this->assertNull($textItem->fillTransform);
        $this->assertNull($textItem->fontFamily);
        $this->assertNull($textItem->fontSize);
        $this->assertNull($textItem->fontStyle);
        $this->assertNull($textItem->fontWeight);
        $this->assertNull($textItem->letterSpacing);
        $this->assertNull($textItem->stroke);
        $this->assertNull($textItem->strokeOpacity);
        $this->assertNull($textItem->strokeTransform);
        $this->assertNull($textItem->strokeWidth);
        $this->assertNull($textItem->text);
        $this->assertNull($textItem->textAnchor);
        $this->assertNull($textItem->x);
        $this->assertNull($textItem->y);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $textItem = new Text(
            fill: '#green',
            fillOpacity: 75,
            fillTransform: 'translate(10, 20)',
            fontFamily: 'Helvetica',
            fontSize: 18,
            fontStyle: FontStyle::NORMAL,
            fontWeight: FontWeight::W100,
            letterSpacing: 1,
            stroke: '#purple',
            strokeOpacity: 85,
            strokeTransform: 'skewY(15)',
            strokeWidth: 2,
            text: 'Sample Text',
            textAnchor: TextAnchor::END,
            x: 50,
            y: 75
        );

        $result = $textItem->jsonSerialize();

        $this->assertSame(AVGItemType::TEXT->value, $result['type']);
        $this->assertSame('#green', $result['fill']);
        $this->assertSame(75, $result['fillOpacity']);
        $this->assertSame('translate(10, 20)', $result['fillTransform']);
        $this->assertSame('Helvetica', $result['fontFamily']);
        $this->assertSame(18, $result['fontSize']);
        $this->assertSame(FontStyle::NORMAL->value, $result['fontStyle']);
        $this->assertSame(FontWeight::W100->value, $result['fontWeight']);
        $this->assertSame(1, $result['letterSpacing']);
        $this->assertSame('#purple', $result['stroke']);
        $this->assertSame(85, $result['strokeOpacity']);
        $this->assertSame('skewY(15)', $result['strokeTransform']);
        $this->assertSame(2, $result['strokeWidth']);
        $this->assertSame('Sample Text', $result['text']);
        $this->assertSame(TextAnchor::END->value, $result['textAnchor']);
        $this->assertSame(50, $result['x']);
        $this->assertSame(75, $result['y']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $textItem = new Text();
        $result = $textItem->jsonSerialize();

        $this->assertSame(AVGItemType::TEXT->value, $result['type']);
        $this->assertArrayNotHasKey('fill', $result);
        $this->assertArrayNotHasKey('fillOpacity', $result);
        $this->assertArrayNotHasKey('fillTransform', $result);
        $this->assertArrayNotHasKey('fontFamily', $result);
        $this->assertArrayNotHasKey('fontSize', $result);
        $this->assertArrayNotHasKey('fontStyle', $result);
        $this->assertArrayNotHasKey('fontWeight', $result);
        $this->assertArrayNotHasKey('letterSpacing', $result);
        $this->assertArrayNotHasKey('stroke', $result);
        $this->assertArrayNotHasKey('strokeOpacity', $result);
        $this->assertArrayNotHasKey('strokeTransform', $result);
        $this->assertArrayNotHasKey('strokeWidth', $result);
        $this->assertArrayNotHasKey('text', $result);
        $this->assertArrayNotHasKey('textAnchor', $result);
        $this->assertArrayNotHasKey('x', $result);
        $this->assertArrayNotHasKey('y', $result);
    }

    public function testJsonSerializeWithFontStyleValues(): void
    {
        $fontStyles = [FontStyle::NORMAL, FontStyle::ITALIC];

        foreach ($fontStyles as $fontStyle) {
            $textItem = new Text(fontStyle: $fontStyle);
            $result = $textItem->jsonSerialize();

            $this->assertSame($fontStyle->value, $result['fontStyle']);
        }
    }

    public function testJsonSerializeWithFontWeightValues(): void
    {
        $fontWeights = [FontWeight::W100, FontWeight::NORMAL, FontWeight::BOLD];

        foreach ($fontWeights as $fontWeight) {
            $textItem = new Text(fontWeight: $fontWeight);
            $result = $textItem->jsonSerialize();

            $this->assertSame($fontWeight->value, $result['fontWeight']);
        }
    }

    public function testJsonSerializeWithTextAnchorValues(): void
    {
        $textAnchors = [TextAnchor::START, TextAnchor::MIDDLE, TextAnchor::END];

        foreach ($textAnchors as $textAnchor) {
            $textItem = new Text(textAnchor: $textAnchor);
            $result = $textItem->jsonSerialize();

            $this->assertSame($textAnchor->value, $result['textAnchor']);
        }
    }

    public function testJsonSerializeWithZeroValues(): void
    {
        $textItem = new Text(
            fillOpacity: 0,
            fontSize: 0,
            letterSpacing: 0,
            strokeOpacity: 0,
            strokeWidth: 0,
            x: 0,
            y: 0
        );
        $result = $textItem->jsonSerialize();

        $this->assertSame(0, $result['fillOpacity']);
        $this->assertSame(0, $result['fontSize']);
        $this->assertSame(0, $result['letterSpacing']);
        $this->assertSame(0, $result['strokeOpacity']);
        $this->assertSame(0, $result['strokeWidth']);
        $this->assertSame(0, $result['x']);
        $this->assertSame(0, $result['y']);
    }

    public function testJsonSerializeWithNegativeCoordinates(): void
    {
        $textItem = new Text(x: -10, y: -20);
        $result = $textItem->jsonSerialize();

        $this->assertSame(-10, $result['x']);
        $this->assertSame(-20, $result['y']);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $textItem = new Text(
            fontFamily: 'Times New Roman',
            text: 'Partial Text',
            textAnchor: TextAnchor::START
        );
        $result = $textItem->jsonSerialize();

        $this->assertSame(AVGItemType::TEXT->value, $result['type']);
        $this->assertSame('Times New Roman', $result['fontFamily']);
        $this->assertSame('Partial Text', $result['text']);
        $this->assertSame(TextAnchor::START->value, $result['textAnchor']);
        $this->assertArrayNotHasKey('fill', $result);
        $this->assertArrayNotHasKey('fontSize', $result);
        $this->assertArrayNotHasKey('x', $result);
        $this->assertArrayNotHasKey('y', $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(AVGItemType::TEXT, Text::TYPE);
    }

    public function testExtendsAVGItem(): void
    {
        $textItem = new Text();

        $this->assertInstanceOf(AVGItem::class, $textItem);
    }

    public function testImplementsJsonSerializable(): void
    {
        $textItem = new Text();

        $this->assertInstanceOf(\JsonSerializable::class, $textItem);
    }
}
