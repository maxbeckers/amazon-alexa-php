<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

class Style implements \JsonSerializable
{
    /**
     * @param string|null $description Optional description of this style
     * @param string[]|null $extend List of styles that this style inherits from (array)
     * @param string|null $extends Single style that this style inherits from (string)
     * @param StyleValue|null $value Single style value object
     * @param StyleValue[]|null $values Array of style value objects
     */
    public function __construct(
        public ?string $description = null,
        public ?array $extend = null,
        public ?string $extends = null,
        public ?StyleValue $value = null,
        public ?array $values = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->description !== null && $this->description !== '') {
            $data['description'] = $this->description;
        }
        if ($this->extend !== null && $this->extend !== []) {
            $data['extend'] = $this->extend;
        }
        if ($this->extends !== null && $this->extends !== '') {
            $data['extends'] = $this->extends;
        }
        if ($this->value instanceof StyleValue) {
            $data['value'] = $this->value;
        }
        if ($this->values !== null && $this->values !== []) {
            $data['values'] = $this->values;
        }

        return $data;
    }
}
