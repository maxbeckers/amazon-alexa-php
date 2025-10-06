<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity;

class TypeValue implements \JsonSerializable
{
    public function __construct(
        public string $id = '',
        public string $value = '',
        public array $synonyms = []
    ) {
    }

    public static function create(string $id, string $value, array $synonyms = []): self
    {
        return new self($id, $value, $synonyms);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => [
                'value' => $this->value,
                'synonyms' => $this->synonyms,
            ],
        ];
    }
}
