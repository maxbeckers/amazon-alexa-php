<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\EditTextComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontStyle;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontWeight;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\KeyboardType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SecureInputType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SubmitKeyType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class EditTextComponentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $borderColor = '#ff0000';
        $fontStyle = FontStyle::ITALIC;
        $keyboardType = KeyboardType::EMAIL_ADDRESS;
        $onTextChange = [$this->createMock(AbstractStandardCommand::class)];
        $secureInput = SecureInputType::DECIMAL_PAD;

        $component = new EditTextComponent(
            borderColor: $borderColor,
            fontStyle: $fontStyle,
            keyboardType: $keyboardType,
            onTextChange: $onTextChange,
            secureInput: $secureInput
        );

        $this->assertSame($borderColor, $component->borderColor);
        $this->assertSame($fontStyle, $component->fontStyle);
        $this->assertSame($keyboardType, $component->keyboardType);
        $this->assertSame($onTextChange, $component->onTextChange);
        $this->assertSame($secureInput, $component->secureInput);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $component = new EditTextComponent();

        $this->assertNull($component->borderColor);
        $this->assertSame('0', $component->borderWidth);
        $this->assertSame('sans-serif', $component->fontFamily);
        $this->assertSame('40dp', $component->fontSize);
        $this->assertSame('', $component->hint);
        $this->assertSame(0, $component->maxLength);
        $this->assertFalse($component->selectOnFocus);
        $this->assertSame(8, $component->size);
        $this->assertSame('', $component->text);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $onSubmit = [$this->createMock(AbstractStandardCommand::class)];

        $component = new EditTextComponent(
            borderColor: '#blue',
            color: '#red',
            fontWeight: FontWeight::BOLD,
            hint: 'Enter text',
            maxLength: 100,
            onSubmit: $onSubmit,
            selectOnFocus: true,
            text: 'Initial text'
        );

        $result = $component->jsonSerialize();

        $this->assertSame(APLComponentType::EDIT_TEXT->value, $result['type']);
        $this->assertSame('#blue', $result['borderColor']);
        $this->assertSame('#red', $result['color']);
        $this->assertSame(FontWeight::BOLD->value, $result['fontWeight']);
        $this->assertSame('Enter text', $result['hint']);
        $this->assertSame(100, $result['maxLength']);
        $this->assertSame($onSubmit, $result['onSubmit']);
        $this->assertTrue($result['selectOnFocus']);
        $this->assertSame('Initial text', $result['text']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $component = new EditTextComponent();
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('borderWidth', $result);
        $this->assertArrayNotHasKey('fontFamily', $result);
        $this->assertArrayNotHasKey('fontSize', $result);
        $this->assertArrayNotHasKey('hint', $result);
        $this->assertArrayNotHasKey('maxLength', $result);
        $this->assertArrayNotHasKey('selectOnFocus', $result);
        $this->assertArrayNotHasKey('size', $result);
        $this->assertArrayNotHasKey('text', $result);
    }

    public function testJsonSerializeWithNonDefaultValues(): void
    {
        $component = new EditTextComponent(
            borderWidth: '2px',
            fontFamily: 'Arial',
            fontSize: '20dp',
            size: 16
        );

        $result = $component->jsonSerialize();

        $this->assertSame('2px', $result['borderWidth']);
        $this->assertSame('Arial', $result['fontFamily']);
        $this->assertSame('20dp', $result['fontSize']);
        $this->assertSame(16, $result['size']);
    }

    public function testJsonSerializeWithEmptyCommands(): void
    {
        $component = new EditTextComponent(onTextChange: [], onSubmit: []);
        $result = $component->jsonSerialize();

        $this->assertArrayNotHasKey('onTextChange', $result);
        $this->assertArrayNotHasKey('onSubmit', $result);
    }

    public function testJsonSerializeWithEnumProperties(): void
    {
        $component = new EditTextComponent(
            fontStyle: FontStyle::NORMAL,
            hintStyle: FontStyle::ITALIC,
            submitKeyType: SubmitKeyType::DONE
        );

        $result = $component->jsonSerialize();

        $this->assertSame(FontStyle::NORMAL->value, $result['fontStyle']);
        $this->assertSame(FontStyle::ITALIC->value, $result['hintStyle']);
        $this->assertSame(SubmitKeyType::DONE->value, $result['submitKeyType']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(APLComponentType::EDIT_TEXT, EditTextComponent::TYPE);
    }
}
