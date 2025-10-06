<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Gradient;

class FrameComponent extends APLBaseComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::FRAME;

    /**
     * @param Gradient|string|null $background Background fill that allows either a color or gradient
     * @param string|null $backgroundColor Background color (ignored if background is provided)
     * @param string|null $borderBottomLeftRadius Radius of the bottom-left corner
     * @param string|null $borderBottomRightRadius Radius of the bottom-right corner
     * @param string|null $borderColor Color of the border
     * @param string $borderRadius Corner radius for rounded-rectangle variant
     * @param string|null $borderStrokeWidth Width of the border stroke
     * @param string|null $borderTopLeftRadius Radius of the top-left corner
     * @param string|null $borderTopRightRadius Radius of the top-right corner
     * @param string $borderWidth Width of the border
     * @param APLBaseComponent|null $item Single child component to display inside the Frame
     * @param APLBaseComponent[]|null $items Array of child components to display inside the Frame
     */
    public function __construct(
        public Gradient|string|null $background = null,
        public ?string $backgroundColor = null,
        public ?string $borderBottomLeftRadius = null,
        public ?string $borderBottomRightRadius = null,
        public ?string $borderColor = null,
        public string $borderRadius = '0',
        public ?string $borderStrokeWidth = null,
        public ?string $borderTopLeftRadius = null,
        public ?string $borderTopRightRadius = null,
        public string $borderWidth = '0',
        public ?APLBaseComponent $item = null,
        public ?array $items = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->background !== null) {
            $data['background'] = $this->background;
        }

        if ($this->backgroundColor !== null) {
            $data['backgroundColor'] = $this->backgroundColor;
        }

        if ($this->borderBottomLeftRadius !== null) {
            $data['borderBottomLeftRadius'] = $this->borderBottomLeftRadius;
        }

        if ($this->borderBottomRightRadius !== null) {
            $data['borderBottomRightRadius'] = $this->borderBottomRightRadius;
        }

        if ($this->borderColor !== null) {
            $data['borderColor'] = $this->borderColor;
        }

        if ($this->borderRadius !== '0') {
            $data['borderRadius'] = $this->borderRadius;
        }

        if ($this->borderStrokeWidth !== null) {
            $data['borderStrokeWidth'] = $this->borderStrokeWidth;
        }

        if ($this->borderTopLeftRadius !== null) {
            $data['borderTopLeftRadius'] = $this->borderTopLeftRadius;
        }

        if ($this->borderTopRightRadius !== null) {
            $data['borderTopRightRadius'] = $this->borderTopRightRadius;
        }

        if ($this->borderWidth !== '0') {
            $data['borderWidth'] = $this->borderWidth;
        }

        if ($this->item !== null) {
            $data['item'] = $this->item;
        }

        if ($this->items !== null && !empty($this->items)) {
            $data['items'] = $this->items;
        }

        return $data;
    }
}
