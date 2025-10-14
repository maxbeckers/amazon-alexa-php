<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontStyle;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontWeight;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAlignVertical;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class TextComponent extends APLBaseComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::TEXT;

    /**
     * @param string|null $color The color of the text
     * @param string $fontFamily Font family (such as "Amazon Ember Display")
     * @param string $fontSize The size of the text
     * @param FontStyle|null $fontStyle The font style to display
     * @param FontWeight|null $fontWeight The font weight to display
     * @param string $lang The language of the text
     * @param string $letterSpacing Additional space to add between letters
     * @param string $lineHeight Line-height multiplier
     * @param int $maxLines The maximum number of lines of text to display
     * @param AbstractStandardCommand[]|null $onTextLayout Commands to run when the text layout changes
     * @param string $text The markup to display in this text box
     * @param TextAlign|null $textAlign Alignment of text within a paragraph
     * @param TextAlignVertical|null $textAlignVertical Vertical alignment of text
     */
    public function __construct(
        public ?string $color = null,
        public string $fontFamily = 'sans-serif',
        public string $fontSize = '40dp',
        public ?FontStyle $fontStyle = null,
        public ?FontWeight $fontWeight = null,
        public string $lang = '',
        public string $letterSpacing = '0',
        public string $lineHeight = '125%',
        public int $maxLines = 0,
        public ?array $onTextLayout = null,
        public string $text = '',
        public ?TextAlign $textAlign = null,
        public ?TextAlignVertical $textAlignVertical = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        // Scalars with null check
        $this->includeIfNotNull($data, 'color', $this->color);

        // Scalars with defaults
        $this->includeIfNotDefault($data, 'fontFamily', $this->fontFamily, 'sans-serif');
        $this->includeIfNotDefault($data, 'fontSize', $this->fontSize, '40dp');
        $this->includeIfNotDefault($data, 'lang', $this->lang, '');
        $this->includeIfNotDefault($data, 'letterSpacing', $this->letterSpacing, '0');
        $this->includeIfNotDefault($data, 'lineHeight', $this->lineHeight, '125%');
        $this->includeIfNotDefault($data, 'maxLines', $this->maxLines, 0);
        $this->includeIfNotDefault($data, 'text', $this->text, '');

        // Enums
        $this->includeEnum($data, 'fontStyle', $this->fontStyle);
        $this->includeEnum($data, 'fontWeight', $this->fontWeight);
        $this->includeEnum($data, 'textAlign', $this->textAlign);
        $this->includeEnum($data, 'textAlignVertical', $this->textAlignVertical);

        // Arrays (commands)
        $this->includeArrayIfNotEmpty($data, 'onTextLayout', $this->onTextLayout);

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function includeIfNotNull(array &$data, string $key, mixed $value): void
    {
        if ($value !== null) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param int|float|string $default
     */
    private function includeIfNotDefault(array &$data, string $key, mixed $value, mixed $default): void
    {
        if ($value !== $default) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function includeEnum(array &$data, string $key, ?\UnitEnum $enum): void
    {
        if ($enum !== null) {
            $data[$key] = $enum->value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param array<mixed>|null $value
     */
    private function includeArrayIfNotEmpty(array &$data, string $key, ?array $value): void
    {
        if ($value !== null && $value !== []) {
            $data[$key] = $value;
        }
    }
}
