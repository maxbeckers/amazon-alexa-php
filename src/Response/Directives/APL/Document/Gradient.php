<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

class Gradient implements \JsonSerializable
{
    /**
     * @param string[] $colorRange Array of colors for the gradient
     * @param string $description Description of the gradient
     * @param BackgroundType $type Type of gradient (linear or radial)
     * @param float[]|null $inputRange Array of input range values
     * @param int $angle Angle for linear gradients
     */
    public function __construct(
        public array $colorRange,
        public string $description = '',
        public BackgroundType $type = BackgroundType::LINEAR,
        public ?array $inputRange = [],
        public int $angle = 0,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'description' => $this->description,
            'colorRange' => $this->colorRange,
            'angle' => $this->angle,
            'type' => $this->type,
        ];

        if ($this->inputRange !== null && count($this->inputRange) > 0) {
            $data['inputRange'] = $this->inputRange;
        }

        return $data;
    }
}
