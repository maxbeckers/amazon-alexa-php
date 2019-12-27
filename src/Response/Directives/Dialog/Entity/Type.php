<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity;

class Type
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var TypeValue[]
     */
    public $values;

    /**
     * @param string      $name
     * @param TypeValue[] $values
     *
     * @return Type
     */
    public static function create(string $name, array $values): self
    {
        $type = new self();

        $type->name   = $name;
        $type->values = $values;

        return $type;
    }
}
