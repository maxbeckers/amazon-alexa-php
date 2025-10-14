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
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
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

        $this->applyScalarWithNull($data, 'borderColor', $this->borderColor);
        $this->applyScalarWithNull($data, 'borderStrokeWidth', $this->borderStrokeWidth);
        $this->applyNonDefault($data, 'borderWidth', $this->borderWidth, '0');
        $this->applyScalarWithNull($data, 'color', $this->color);
        $this->applyNonDefault($data, 'fontFamily', $this->fontFamily, 'sans-serif');
        $this->applyNonDefault($data, 'fontSize', $this->fontSize, '40dp');

        $this->applyEnum($data, 'fontStyle', $this->fontStyle);
        $this->applyEnum($data, 'fontWeight', $this->fontWeight);
        $this->applyScalarWithNull($data, 'highlightColor', $this->highlightColor);
        $this->applyNonDefault($data, 'hint', $this->hint, '');
        $this->applyScalarWithNull($data, 'hintColor', $this->hintColor);
        $this->applyEnum($data, 'hintStyle', $this->hintStyle);
        $this->applyEnum($data, 'hintWeight', $this->hintWeight);
        $this->applyEnum($data, 'keyboardType', $this->keyboardType);
        $this->applyNonDefault($data, 'lang', $this->lang, '');
        $this->applyNonDefault($data, 'maxLength', $this->maxLength, 0);
        $this->applyCommandsArray($data, 'onTextChange', $this->onTextChange);
        $this->applyCommandsArray($data, 'onSubmit', $this->onSubmit);
        $this->applyEnum($data, 'secureInput', $this->secureInput);
        $this->applyBooleanTrue($data, 'selectOnFocus', $this->selectOnFocus);
        $this->applyNonDefault($data, 'size', $this->size, 8);
        $this->applyEnum($data, 'submitKeyType', $this->submitKeyType);
        $this->applyNonDefault($data, 'text', $this->text, '');
        $this->applyNonDefault($data, 'validCharacters', $this->validCharacters, '');

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function applyScalarWithNull(array &$data, string $key, mixed $value): void
    {
        if ($value !== null) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param int|float|string $default
     */
    private function applyNonDefault(array &$data, string $key, mixed $value, mixed $default): void
    {
        if ($value !== $default) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function applyEnum(array &$data, string $key, ?\UnitEnum $enum): void
    {
        if ($enum !== null) {
            $data[$key] = $enum->value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param AbstractStandardCommand[]|null $commands
     */
    private function applyCommandsArray(array &$data, string $key, ?array $commands): void
    {
        if ($commands !== null && $commands !== []) {
            $data[$key] = $commands;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function applyBooleanTrue(array &$data, string $key, bool $flag): void
    {
        if ($flag) {
            $data[$key] = true;
        }
    }
}
