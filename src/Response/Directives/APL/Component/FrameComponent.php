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

        $this->addScalar($data, 'background', $this->background);
        $this->addScalar($data, 'backgroundColor', $this->backgroundColor);
        $this->addScalar($data, 'borderBottomLeftRadius', $this->borderBottomLeftRadius);
        $this->addScalar($data, 'borderBottomRightRadius', $this->borderBottomRightRadius);
        $this->addScalar($data, 'borderColor', $this->borderColor);
        $this->addNonDefault($data, 'borderRadius', $this->borderRadius, '0');
        $this->addScalar($data, 'borderStrokeWidth', $this->borderStrokeWidth);
        $this->addScalar($data, 'borderTopLeftRadius', $this->borderTopLeftRadius);
        $this->addScalar($data, 'borderTopRightRadius', $this->borderTopRightRadius);
        $this->addNonDefault($data, 'borderWidth', $this->borderWidth, '0');
        $this->addScalar($data, 'item', $this->item);
        $this->addArrayIfNotEmpty($data, 'items', $this->items);

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
     * @param string $default
     */
    private function addNonDefault(array &$data, string $key, string $value, string $default): void
    {
        if ($value !== $default) {
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
}
