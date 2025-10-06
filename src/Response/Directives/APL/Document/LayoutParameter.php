<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

class LayoutParameter implements \JsonSerializable
{
    public function __construct(
        public string $name,
        public mixed $default = null,
        public ?string $description = null,
        public LayoutParameterType $type = LayoutParameterType::ANY,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'name' => $this->name,
            'type' => $this->type,
        ];

        if ($this->default !== null) {
            $data['default'] = $this->default;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        return $data;
    }
}
