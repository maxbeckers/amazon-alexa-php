<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StrokeLineCap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StrokeLineJoin;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Path extends AVGItem implements \JsonSerializable
{
    public const TYPE = AVGItemType::PATH;

    /**
     * @param string|null $fill Fill color
     * @param int|null $fillOpacity Fill opacity
     * @param string|null $fillTransform Fill transform
     * @param string|null $pathData Path data string
     * @param int|null $pathLength Path length
     * @param string|null $stroke Stroke color
     * @param int[]|null $strokeDashArray Array of dash lengths
     * @param int|null $strokeDashOffset Dash offset
     * @param StrokeLineCap|null $strokeLineCap Line cap style
     * @param StrokeLineJoin|null $strokeLineJoin Line join style
     * @param int|null $strokeMiterLimit Miter limit
     * @param int|null $strokeOpacity Stroke opacity
     * @param string|null $strokeTransform Stroke transform
     * @param int|null $strokeWidth Stroke width
     */
    public function __construct(
        public ?string $fill = null,
        public ?int $fillOpacity = null,
        public ?string $fillTransform = null,
        public ?string $pathData = null,
        public ?int $pathLength = null,
        public ?string $stroke = null,
        public ?array $strokeDashArray = null,
        public ?int $strokeDashOffset = null,
        public ?StrokeLineCap $strokeLineCap = null,
        public ?StrokeLineJoin $strokeLineJoin = null,
        public ?int $strokeMiterLimit = null,
        public ?int $strokeOpacity = null,
        public ?string $strokeTransform = null,
        public ?int $strokeWidth = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        $this->addScalar($data, 'fill', $this->fill);
        $this->addScalar($data, 'fillOpacity', $this->fillOpacity);
        $this->addScalar($data, 'fillTransform', $this->fillTransform);
        $this->addScalar($data, 'pathData', $this->pathData);
        $this->addScalar($data, 'pathLength', $this->pathLength);
        $this->addScalar($data, 'stroke', $this->stroke);
        $this->addArrayIfNotEmpty($data, 'strokeDashArray', $this->strokeDashArray);
        $this->addScalar($data, 'strokeDashOffset', $this->strokeDashOffset);
        $this->addEnum($data, 'strokeLineCap', $this->strokeLineCap);
        $this->addEnum($data, 'strokeLineJoin', $this->strokeLineJoin);
        $this->addScalar($data, 'strokeMiterLimit', $this->strokeMiterLimit);
        $this->addScalar($data, 'strokeOpacity', $this->strokeOpacity);
        $this->addScalar($data, 'strokeTransform', $this->strokeTransform);
        $this->addScalar($data, 'strokeWidth', $this->strokeWidth);

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
     * @param array<mixed>|null $value
     */
    private function addArrayIfNotEmpty(array &$data, string $key, ?array $value): void
    {
        if ($value !== null && $value !== []) {
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
