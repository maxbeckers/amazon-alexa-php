<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity;

class Type
{
    public string $name;

    /** @var TypeValue[] */
    public array $values;

    public static function create(string $name, array $values): self
    {
        $type = new self();

        $type->name = $name;
        $type->values = $values;

        return $type;
    }
}
