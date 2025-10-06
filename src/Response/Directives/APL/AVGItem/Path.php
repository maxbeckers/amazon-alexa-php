<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StrokeLineCap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StrokeLineJoin;

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

        if ($this->fill !== null) {
            $data['fill'] = $this->fill;
        }

        if ($this->fillOpacity !== null) {
            $data['fillOpacity'] = $this->fillOpacity;
        }

        if ($this->fillTransform !== null) {
            $data['fillTransform'] = $this->fillTransform;
        }

        if ($this->pathData !== null) {
            $data['pathData'] = $this->pathData;
        }

        if ($this->pathLength !== null) {
            $data['pathLength'] = $this->pathLength;
        }

        if ($this->stroke !== null) {
            $data['stroke'] = $this->stroke;
        }

        if ($this->strokeDashArray !== null && !empty($this->strokeDashArray)) {
            $data['strokeDashArray'] = $this->strokeDashArray;
        }

        if ($this->strokeDashOffset !== null) {
            $data['strokeDashOffset'] = $this->strokeDashOffset;
        }

        if ($this->strokeLineCap !== null) {
            $data['strokeLineCap'] = $this->strokeLineCap->value;
        }

        if ($this->strokeLineJoin !== null) {
            $data['strokeLineJoin'] = $this->strokeLineJoin->value;
        }

        if ($this->strokeMiterLimit !== null) {
            $data['strokeMiterLimit'] = $this->strokeMiterLimit;
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

        return $data;
    }
}
