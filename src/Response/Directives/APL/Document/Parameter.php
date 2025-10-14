<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Parameter implements \JsonSerializable
{
    public function __construct(
        public string $name,
        public mixed $default = null,
        public ?string $description = null,
        public ?ParameterType $type = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'name' => $this->name,
        ];

        if ($this->type !== null) {
            $data['type'] = $this->type;
        }

        if ($this->default !== null) {
            $data['default'] = $this->default;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        return $data;
    }
}
