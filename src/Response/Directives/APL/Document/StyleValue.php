<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class StyleValue implements \JsonSerializable
{
    /**
     * When is an optional APL boolean expression controlling whether this style value block applies.
     * If null, the block always applies.
     */
    public function __construct(
        public ?string $when = null,
        public array $properties = [],
    ) {
    }

    public function set(string $name, mixed $value): self
    {
        if ($name === 'when') {
            $this->when = is_string($value) ? $value : null;
        } else {
            $this->properties[$name] = $value;
        }

        return $this;
    }

    public function jsonSerialize(): array
    {
        $out = $this->properties;
        if ($this->when !== null && $this->when !== '') {
            // Ensure 'when' appears first for readability (JSON object order not semantically relevant).
            $out = ['when' => $this->when] + $out;
        }

        return $out;
    }
}
