<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\AVGItem;

class Graphic implements \JsonSerializable
{
    /**
     * @param int $height Height of the graphic
     * @param int $width Width of the graphic
     * @param array|null $data Array of arbitrary data for inflation
     * @param string $description Description of the graphic
     * @param AVGItem|null $item Single AVG item to display
     * @param AVGItem[]|null $items Array of AVG items to display
     * @param string|null $lang Language of the graphic
     * @param LayoutDirection $layoutDirection Direction for rendering
     * @param Parameter[] $parameters Array of AVG parameters
     * @param array $resources Array of local graphic-specific resources
     * @param ScaleType $scaleTypeHeight How to scale height
     * @param ScaleType $scaleTypeWidth How to scale width
     * @param Style[] $styles Array of styles
     * @param string $type Type of graphic (must be "AVG")
     * @param string $version Version of AVG specification
     * @param int|null $viewportHeight Viewport height
     * @param int|null $viewportWidth Viewport width
     */
    public function __construct(
        public int $height,
        public int $width,
        public ?array $data = null,
        public string $description = '',
        public ?AVGItem $item = null,
        public ?array $items = null,
        public ?string $lang = null,
        public LayoutDirection $layoutDirection = LayoutDirection::LTR,
        public array $parameters = [],
        public array $resources = [],
        public ScaleType $scaleTypeHeight = ScaleType::NONE,
        public ScaleType $scaleTypeWidth = ScaleType::NONE,
        public array $styles = [],
        public string $type = 'AVG',
        public string $version = '1.2',
        public ?int $viewportHeight = null,
        public ?int $viewportWidth = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'data' => $this->data,
            'description' => $this->description,
            'height' => $this->height,
            'item' => $this->item,
            'items' => $this->items,
            'lang' => $this->lang,
            'layoutDirection' => $this->layoutDirection,
            'parameters' => $this->parameters,
            'resources' => $this->resources,
            'scaleTypeHeight' => $this->scaleTypeHeight,
            'scaleTypeWidth' => $this->scaleTypeWidth,
            'styles' => $this->styles,
            'type' => $this->type,
            'version' => $this->version,
            'viewportHeight' => $this->viewportHeight,
            'viewportWidth' => $this->viewportWidth,
            'width' => $this->width,
        ], fn ($value) => $value !== null && $value !== []);
    }
}
