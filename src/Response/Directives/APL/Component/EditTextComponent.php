<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontStyle;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontWeight;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\KeyboardType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SecureInputType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SubmitKeyType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class EditTextComponent extends ActionableComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::EDIT_TEXT;

    /**
     * @param string|null $borderColor Color of the border around the text box
     * @param string|null $borderStrokeWidth Width of the border stroke around the text box
     * @param string $borderWidth Width of the border
     * @param string|null $color Color of the text the user enters
     * @param string $fontFamily The name of the font family
     * @param string $fontSize The size of the text
     * @param FontStyle|null $fontStyle The style of the font
     * @param FontWeight|null $fontWeight The weight of the font
     * @param string|null $highlightColor The highlight color to show behind selected text
     * @param string $hint Hint text to display when no text has been entered
     * @param string|null $hintColor The color of the hint text
     * @param FontStyle|null $hintStyle The style of the hint font
     * @param FontWeight|null $hintWeight The weight of the hint font
     * @param KeyboardType|null $keyboardType The type of keyboard to display
     * @param string $lang The language of the text
     * @param int $maxLength The maximum number of characters the user can enter
     * @param AbstractStandardCommand[]|null $onTextChange Commands to run when the text changes
     * @param AbstractStandardCommand[]|null $onSubmit Commands to run when the user submits
     * @param SecureInputType|null $secureInput Hide characters as they are typed if specified
     * @param bool $selectOnFocus When true, select the text when the EditText component gets focus
     * @param int $size Specifies approximately the number of characters to display
     * @param SubmitKeyType|null $submitKeyType The type of the return key
     * @param string $text The text to display
     * @param string $validCharacters Restrict the characters that can be entered
     */
    public function __construct(
        public ?string $borderColor = null,
        public ?string $borderStrokeWidth = null,
        public string $borderWidth = '0',
        public ?string $color = null,
        public string $fontFamily = 'sans-serif',
        public string $fontSize = '40dp',
        public ?FontStyle $fontStyle = null,
        public ?FontWeight $fontWeight = null,
        public ?string $highlightColor = null,
        public string $hint = '',
        public ?string $hintColor = null,
        public ?FontStyle $hintStyle = null,
        public ?FontWeight $hintWeight = null,
        public ?KeyboardType $keyboardType = null,
        public string $lang = '',
        public int $maxLength = 0,
        public ?array $onTextChange = null,
        public ?array $onSubmit = null,
        public ?SecureInputType $secureInput = null,
        public bool $selectOnFocus = false,
        public int $size = 8,
        public ?SubmitKeyType $submitKeyType = null,
        public string $text = '',
        public string $validCharacters = '',
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->borderColor !== null) {
            $data['borderColor'] = $this->borderColor;
        }

        if ($this->borderStrokeWidth !== null) {
            $data['borderStrokeWidth'] = $this->borderStrokeWidth;
        }

        if ($this->borderWidth !== '0') {
            $data['borderWidth'] = $this->borderWidth;
        }

        if ($this->color !== null) {
            $data['color'] = $this->color;
        }

        if ($this->fontFamily !== 'sans-serif') {
            $data['fontFamily'] = $this->fontFamily;
        }

        if ($this->fontSize !== '40dp') {
            $data['fontSize'] = $this->fontSize;
        }

        if ($this->fontStyle !== null) {
            $data['fontStyle'] = $this->fontStyle->value;
        }

        if ($this->fontWeight !== null) {
            $data['fontWeight'] = $this->fontWeight->value;
        }

        if ($this->highlightColor !== null) {
            $data['highlightColor'] = $this->highlightColor;
        }

        if ($this->hint !== '') {
            $data['hint'] = $this->hint;
        }

        if ($this->hintColor !== null) {
            $data['hintColor'] = $this->hintColor;
        }

        if ($this->hintStyle !== null) {
            $data['hintStyle'] = $this->hintStyle->value;
        }

        if ($this->hintWeight !== null) {
            $data['hintWeight'] = $this->hintWeight->value;
        }

        if ($this->keyboardType !== null) {
            $data['keyboardType'] = $this->keyboardType->value;
        }

        if ($this->lang !== '') {
            $data['lang'] = $this->lang;
        }

        if ($this->maxLength !== 0) {
            $data['maxLength'] = $this->maxLength;
        }

        if ($this->onTextChange !== null && !empty($this->onTextChange)) {
            $data['onTextChange'] = $this->onTextChange;
        }

        if ($this->onSubmit !== null && !empty($this->onSubmit)) {
            $data['onSubmit'] = $this->onSubmit;
        }

        if ($this->secureInput !== null) {
            $data['secureInput'] = $this->secureInput->value;
        }

        if ($this->selectOnFocus) {
            $data['selectOnFocus'] = $this->selectOnFocus;
        }

        if ($this->size !== 8) {
            $data['size'] = $this->size;
        }

        if ($this->submitKeyType !== null) {
            $data['submitKeyType'] = $this->submitKeyType->value;
        }

        if ($this->text !== '') {
            $data['text'] = $this->text;
        }

        if ($this->validCharacters !== '') {
            $data['validCharacters'] = $this->validCharacters;
        }

        return $data;
    }
}
