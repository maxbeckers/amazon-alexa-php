<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\TextComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontStyle;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontWeight;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAlignVertical;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class TextComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $color = '#ff0000';
        $fontFamily = 'Arial';
        $fontSize = '20dp';
        $fontStyle = FontStyle::ITALIC;
        $fontWeight = FontWeight::BOLD;
        $lang = 'en-US';
        $letterSpacing = '2px';
        $lineHeight = '150%';
        $maxLines = 5;
        $onTextLayout = [$this->createMock(AbstractStandardCommand::class)];
        $text = 'Hello World';
        $textAlign = TextAlign::CENTER;
        $textAlignVertical = TextAlignVertical::CENTER;

        $component = new TextComponent(
            $color,
            $fontFamily,
            $fontSize,
            $fontStyle,
            $fontWeight,
            $lang,
            $letterSpacing,
            $lineHeight,
            $maxLines,
            $onTextLayout,
            $text,
            $textAlign,
            $textAlignVertical
        );

        $this->assertSame($color, $component->color);
        $this->assertSame($fontFamily, $component->fontFamily);
        $this->assertSame($fontSize, $component->fontSize);
        $this->assertSame($fontStyle, $component->fontStyle);
        $this->assertSame($fontWeight, $component->fontWeight);
        $this->assertSame($lang, $component->lang);
        $this->assertSame($letterSpacing, $component->letterSpacing);
        $this->assertSame($lineHeight, $component->lineHeight);
        $this->assertSame($maxLines, $component->maxLines);
        $this->assertSame($onTextLayout, $component->onTextLayout);
        $this->assertSame($text, $component->text);
        $this->assertSame($textAlign, $component->textAlign);
        $this->assertSame($textAlignVertical, $component->textAlignVertical);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new TextComponent();

        $this->assertNull($component->color);
        $this->assertSame('sans-serif', $component->fontFamily);
        $this->assertSame('40dp', $component->fontSize);
        $this->assertNull($component->fontStyle);
        $this->assertNull($component->fontWeight);
        $this->assertSame('', $component->lang);
        $this->assertSame('0', $component->letterSpacing);
        $this->assertSame('125%', $component->lineHeight);
        $this->assertSame(0, $component->maxLines);
        $this->assertNull($component->onTextLayout);
        $this->assertSame('', $component->text);
        $this->assertNull($component->textAlign);
        $this->assertNull($component->textAlignVertical);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $color = '#blue';
        $fontStyle = FontStyle::NORMAL;
        $fontWeight = FontWeight::BOLD;
        $onTextLayout = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];
        $textAlign = TextAlign::LEFT;
        $textAlignVertical = TextAlignVertical::TOP;

        $component = new TextComponent(
            color: $color,
            fontFamily: 'Helvetica',
            fontSize: '16dp',
            fontStyle: $fontStyle,
            fontWeight: $fontWeight,
            lang: 'fr-FR',
            letterSpacing: '1px',
            lineHeight: '140%',
            maxLines: 3,
            onTextLayout: $onTextLayout,
            text: 'Bonjour le monde',
            textAlign: $textAlign,
            textAlignVertical: $textAlignVertical
        );

        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::TEXT->value, $result['type']);
        $this->assertSame($color, $result['color']);
        $this->assertSame('Helvetica', $result['fontFamily']);
        $this->assertSame('16dp', $result['fontSize']);
        $this->assertSame($fontStyle->value, $result['fontStyle']);
        $this->assertSame($fontWeight->value, $result['fontWeight']);
        $this->assertSame('fr-FR', $result['lang']);
        $this->assertSame('1px', $result['letterSpacing']);
        $this->assertSame('140%', $result['lineHeight']);
        $this->assertSame(3, $result['maxLines']);
        $this->assertSame($onTextLayout, $result['onTextLayout']);
        $this->assertSame('Bonjour le monde', $result['text']);
        $this->assertSame($textAlign->value, $result['textAlign']);
        $this->assertSame($textAlignVertical->value, $result['textAlignVertical']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $component = new TextComponent();
        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::TEXT->value, $result['type']);
        $this->assertArrayNotHasKey('fontFamily', $result);
        $this->assertArrayNotHasKey('fontSize', $result);
        $this->assertArrayNotHasKey('lang', $result);
        $this->assertArrayNotHasKey('letterSpacing', $result);
        $this->assertArrayNotHasKey('lineHeight', $result);
        $this->assertArrayNotHasKey('maxLines', $result);
        $this->assertArrayNotHasKey('text', $result);
    }

    public function testJsonSerializeWithNonDefaultValues(): void
    {
        $component = new TextComponent(
            fontFamily: 'Times New Roman',
            fontSize: '24dp',
            lang: 'de-DE',
            letterSpacing: '3px',
            lineHeight: '160%',
            maxLines: 10,
            text: 'Hallo Welt'
        );

        $result = $component->jsonSerialize();

        $this->assertSame('Times New Roman', $result['fontFamily']);
        $this->assertSame('24dp', $result['fontSize']);
        $this->assertSame('de-DE', $result['lang']);
        $this->assertSame('3px', $result['letterSpacing']);
        $this->assertSame('160%', $result['lineHeight']);
        $this->assertSame(10, $result['maxLines']);
        $this->assertSame('Hallo Welt', $result['text']);
    }

    public function testJsonSerializeWithEmptyOnTextLayout(): void
    {
        $component = new TextComponent(onTextLayout: []);
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('onTextLayout', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $component = new TextComponent();
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('color', $result);
        $this->assertArrayNotHasKey('fontStyle', $result);
        $this->assertArrayNotHasKey('fontWeight', $result);
        $this->assertArrayNotHasKey('onTextLayout', $result);
        $this->assertArrayNotHasKey('textAlign', $result);
        $this->assertArrayNotHasKey('textAlignVertical', $result);
    }

    public function testJsonSerializeWithDifferentFontStyles(): void
    {
        $fontStyles = [FontStyle::NORMAL, FontStyle::ITALIC];

        foreach ($fontStyles as $fontStyle) {
            $component = new TextComponent(fontStyle: $fontStyle);
            $result = $component->jsonSerialize();

            $this->assertSame($fontStyle->value, $result['fontStyle']);
        }
    }

    public function testJsonSerializeWithDifferentFontWeights(): void
    {
        $fontWeights = [FontWeight::W100, FontWeight::NORMAL, FontWeight::BOLD];

        foreach ($fontWeights as $fontWeight) {
            $component = new TextComponent(fontWeight: $fontWeight);
            $result = $component->jsonSerialize();

            $this->assertSame($fontWeight->value, $result['fontWeight']);
        }
    }

    public function testJsonSerializeWithDifferentTextAlignments(): void
    {
        $alignments = [TextAlign::LEFT, TextAlign::CENTER, TextAlign::RIGHT];

        foreach ($alignments as $align) {
            $component = new TextComponent(textAlign: $align);
            $result = $component->jsonSerialize();

            $this->assertSame($align->value, $result['textAlign']);
        }
    }

    public function testJsonSerializeWithDifferentVerticalAlignments(): void
    {
        $alignments = [TextAlignVertical::TOP, TextAlignVertical::CENTER, TextAlignVertical::BOTTOM];

        foreach ($alignments as $align) {
            $component = new TextComponent(textAlignVertical: $align);
            $result = $component->jsonSerialize();

            $this->assertSame($align->value, $result['textAlignVertical']);
        }
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::TEXT, TextComponent::TYPE);
    }

    public function testExtendsAPLBaseComponent(): void
    {
        $component = new TextComponent();

        $this->assertInstanceOf(\MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent::class, $component);
    }

    public function testImplementsJsonSerializable(): void
    {
        $component = new TextComponent();

        $this->assertInstanceOf(\JsonSerializable::class, $component);
    }
}
