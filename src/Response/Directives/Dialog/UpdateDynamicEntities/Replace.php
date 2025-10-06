<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities;

use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity\Type;

class Replace extends UpdateDynamicEntities
{
    public const UPDATE_BEHAVIOR = 'REPLACE';

    public function __construct(
        public array $types = []
    ) {
        parent::__construct(self::UPDATE_BEHAVIOR);
    }

    public function addType(Type $type): void
    {
        $this->types[] = $type;
    }

    public static function create(): self
    {
        return new self();
    }
}
