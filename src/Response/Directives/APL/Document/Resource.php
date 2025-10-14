<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
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

        // Simple nullable scalars (include when not null)
        $this->includeIfNotNull($data, 'boolean', $this->boolean);
        $this->includeIfNotEmptyArray($data, 'booleans', $this->booleans);
        $this->includeIfNotNull($data, 'color', $this->color);
        $this->includeIfNotEmptyArray($data, 'colors', $this->colors);
        $this->includeIfNotEmptyString($data, 'description', $this->description);
        $this->includeIfNotNull($data, 'dimension', $this->dimension);
        $this->includeIfNotEmptyArray($data, 'dimensions', $this->dimensions);
        $this->includeIfNotNull($data, 'easing', $this->easing);
        $this->includeIfNotEmptyArray($data, 'easings', $this->easings);
        $this->includeIfNotNull($data, 'gradient', $this->gradient);
        $this->includeIfNotEmptyArray($data, 'gradients', $this->gradients);
        $this->includeIfNotNull($data, 'number', $this->number);
        $this->includeIfNotEmptyArray($data, 'numbers', $this->numbers);
        $this->includeIfNotNull($data, 'string', $this->string);
        $this->includeIfNotEmptyArray($data, 'strings', $this->strings);
        $this->includeIfNotNull($data, 'when', $this->when);

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function includeIfNotNull(array &$data, string $key, mixed $value): void
    {
        if ($value !== null) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param array<mixed>|null $value
     */
    private function includeIfNotEmptyArray(array &$data, string $key, ?array $value): void
    {
        if ($value !== null && $value !== []) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function includeIfNotEmptyString(array &$data, string $key, ?string $value): void
    {
        if ($value !== null && $value !== '') {
            $data[$key] = $value;
        }
    }
}
