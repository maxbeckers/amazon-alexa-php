<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontStyle;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontWeight;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAnchor;

class Text extends AVGItem implements \JsonSerializable
{
    public const TYPE = AVGItemType::TEXT;

    /**
     * @param string|null $fill Fill color
     * @param int|null $fillOpacity Fill opacity
     * @param string|null $fillTransform Fill transform
     * @param string|null $fontFamily Font family
     * @param int|null $fontSize Font size
     * @param FontStyle|null $fontStyle Font style
     * @param FontWeight|null $fontWeight Font weight
     * @param int|null $letterSpacing Letter spacing
     * @param string|null $stroke Stroke color
     * @param int|null $strokeOpacity Stroke opacity
     * @param string|null $strokeTransform Stroke transform
     * @param int|null $strokeWidth Stroke width
     * @param string|null $text Text content
     * @param TextAnchor|null $textAnchor Text anchor position
     * @param int|null $x X coordinate
     * @param int|null $y Y coordinate
     */
    public function __construct(
        public ?string $fill = null,
        public ?int $fillOpacity = null,
        public ?string $fillTransform = null,
        public ?string $fontFamily = null,
        public ?int $fontSize = null,
        public ?FontStyle $fontStyle = null,
        public ?FontWeight $fontWeight = null,
        public ?int $letterSpacing = null,
        public ?string $stroke = null,
        public ?int $strokeOpacity = null,
        public ?string $strokeTransform = null,
        public ?int $strokeWidth = null,
        public ?string $text = null,
        public ?TextAnchor $textAnchor = null,
        public ?int $x = null,
        public ?int $y = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->fill !== null) {
            $data['fill'] = $this->fill;
        }

        if ($this->fillOpacity !== null) {
            $data['fillOpacity'] = $this->fillOpacity;
        }

        if ($this->fillTransform !== null) {
            $data['fillTransform'] = $this->fillTransform;
        }

        if ($this->fontFamily !== null) {
            $data['fontFamily'] = $this->fontFamily;
        }

        if ($this->fontSize !== null) {
            $data['fontSize'] = $this->fontSize;
        }

        if ($this->fontStyle !== null) {
            $data['fontStyle'] = $this->fontStyle->value;
        }

        if ($this->fontWeight !== null) {
            $data['fontWeight'] = $this->fontWeight->value;
        }

        if ($this->letterSpacing !== null) {
            $data['letterSpacing'] = $this->letterSpacing;
        }

        if ($this->stroke !== null) {
            $data['stroke'] = $this->stroke;
        }

        if ($this->strokeOpacity !== null) {
            $data['strokeOpacity'] = $this->strokeOpacity;
        }

        if ($this->strokeTransform !== null) {
            $data['strokeTransform'] = $this->strokeTransform;
        }

        if ($this->strokeWidth !== null) {
            $data['strokeWidth'] = $this->strokeWidth;
        }

        if ($this->text !== null) {
            $data['text'] = $this->text;
        }

        if ($this->textAnchor !== null) {
            $data['textAnchor'] = $this->textAnchor->value;
        }

        if ($this->x !== null) {
            $data['x'] = $this->x;
        }

        if ($this->y !== null) {
            $data['y'] = $this->y;
        }

        return $data;
    }
}
