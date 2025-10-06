<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity;

class Type
{
    /** @var TypeValue[] */
    public function __construct(
        public string $name = '',
        public array $values = []
    ) {
    }

    public static function create(string $name, array $values): self
    {
        return new self($name, $values);
    }
}
