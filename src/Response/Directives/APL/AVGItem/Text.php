<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontStyle;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FontWeight;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TextAnchor;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
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

        $this->addScalar($data, 'fill', $this->fill);
        $this->addScalar($data, 'fillOpacity', $this->fillOpacity);
        $this->addScalar($data, 'fillTransform', $this->fillTransform);
        $this->addScalar($data, 'fontFamily', $this->fontFamily);
        $this->addScalar($data, 'fontSize', $this->fontSize);
        $this->addEnum($data, 'fontStyle', $this->fontStyle);
        $this->addEnum($data, 'fontWeight', $this->fontWeight);
        $this->addScalar($data, 'letterSpacing', $this->letterSpacing);
        $this->addScalar($data, 'stroke', $this->stroke);
        $this->addScalar($data, 'strokeOpacity', $this->strokeOpacity);
        $this->addScalar($data, 'strokeTransform', $this->strokeTransform);
        $this->addScalar($data, 'strokeWidth', $this->strokeWidth);
        $this->addScalar($data, 'text', $this->text);
        $this->addEnum($data, 'textAnchor', $this->textAnchor);
        $this->addScalar($data, 'x', $this->x);
        $this->addScalar($data, 'y', $this->y);

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addScalar(array &$data, string $key, mixed $value): void
    {
        if ($value !== null) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addEnum(array &$data, string $key, ?\UnitEnum $enum): void
    {
        if ($enum !== null) {
            $data[$key] = $enum->value;
        }
    }
}
