<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity;

class TypeValue implements \JsonSerializable
{
    public string $id;
    public string $value;
    public array $synonyms;

    public static function create(string $id, string $value, array $synonyms = []): self
    {
        $typeValue = new self();

        $typeValue->id = $id;
        $typeValue->value = $value;
        $typeValue->synonyms = $synonyms;

        return $typeValue;
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
