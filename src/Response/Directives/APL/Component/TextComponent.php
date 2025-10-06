<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontStyle;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontWeight;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAlignVertical;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

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

        if ($this->lang !== '') {
            $data['lang'] = $this->lang;
        }

        if ($this->letterSpacing !== '0') {
            $data['letterSpacing'] = $this->letterSpacing;
        }

        if ($this->lineHeight !== '125%') {
            $data['lineHeight'] = $this->lineHeight;
        }

        if ($this->maxLines !== 0) {
            $data['maxLines'] = $this->maxLines;
        }

        if ($this->onTextLayout !== null && !empty($this->onTextLayout)) {
            $data['onTextLayout'] = $this->onTextLayout;
        }

        if ($this->text !== '') {
            $data['text'] = $this->text;
        }

        if ($this->textAlign !== null) {
            $data['textAlign'] = $this->textAlign->value;
        }

        if ($this->textAlignVertical !== null) {
            $data['textAlignVertical'] = $this->textAlignVertical->value;
        }

        return $data;
    }
}
