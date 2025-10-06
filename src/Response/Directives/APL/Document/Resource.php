<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

class Resource implements \JsonSerializable
{
    /**
     * @param bool|null $boolean Single boolean value
     * @param array<string,bool>|null $booleans Map of boolean name to boolean value
     * @param string|null $color Single color value
     * @param array<string,string>|null $colors Map of color name to color value
     * @param string|null $description Description of this resource block
     * @param string|null $dimension Single dimension value
     * @param array<string,string>|null $dimensions Map of dimension name to dimension value
     * @param string|null $easing Single easing function
     * @param array<string,string>|null $easings Map of name to easing function definition
     * @param Gradient|null $gradient Single gradient definition
     * @param array<string,Gradient>|null $gradients Map of gradient name to gradient definition
     * @param string|null $number Single number value
     * @param array<string,string>|null $numbers Map of name to number
     * @param string|null $string Single string value
     * @param array<string,string>|null $strings Map of name to string
     * @param string|null $when APL boolean expression controlling whether this resource is considered
     */
    public function __construct(
        public ?bool $boolean = null,
        public ?array $booleans = null,
        public ?string $color = null,
        public ?array $colors = null,
        public ?string $description = null,
        public ?string $dimension = null,
        public ?array $dimensions = null,
        public ?string $easing = null,
        public ?array $easings = null,
        public ?Gradient $gradient = null,
        public ?array $gradients = null,
        public ?string $number = null,
        public ?array $numbers = null,
        public ?string $string = null,
        public ?array $strings = null,
        public ?string $when = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->boolean !== null) {
            $data['boolean'] = $this->boolean;
        }
        if ($this->booleans !== null && $this->booleans !== []) {
            $data['booleans'] = $this->booleans;
        }
        if ($this->color !== null) {
            $data['color'] = $this->color;
        }
        if ($this->colors !== null && $this->colors !== []) {
            $data['colors'] = $this->colors;
        }
        if ($this->description !== null && $this->description !== '') {
            $data['description'] = $this->description;
        }
        if ($this->dimension !== null) {
            $data['dimension'] = $this->dimension;
        }
        if ($this->dimensions !== null && $this->dimensions !== []) {
            $data['dimensions'] = $this->dimensions;
        }
        if ($this->easing !== null) {
            $data['easing'] = $this->easing;
        }
        if ($this->easings !== null && $this->easings !== []) {
            $data['easings'] = $this->easings;
        }
        if ($this->gradient !== null) {
            $data['gradient'] = $this->gradient;
        }
        if ($this->gradients !== null && $this->gradients !== []) {
            $data['gradients'] = $this->gradients;
        }
        if ($this->number !== null) {
            $data['number'] = $this->number;
        }
        if ($this->numbers !== null && $this->numbers !== []) {
            $data['numbers'] = $this->numbers;
        }
        if ($this->string !== null) {
            $data['string'] = $this->string;
        }
        if ($this->strings !== null && $this->strings !== []) {
            $data['strings'] = $this->strings;
        }
        if ($this->when !== null) {
            $data['when'] = $this->when;
        }

        return $data;
    }
}
