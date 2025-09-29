<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities;

use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity\Type;

class Replace extends UpdateDynamicEntities
{
    public const UPDATE_BEHAVIOR = 'REPLACE';

    public ?array $types = null;

    public function addType(Type $type): void
    {
        $this->types[] = $type;
    }

    public static function create(): self
    {
        $directive = new static();

        $directive->type = self::TYPE;
        $directive->types = [];
        $directive->updateBehavior = static::UPDATE_BEHAVIOR;

        return $directive;
    }
}
