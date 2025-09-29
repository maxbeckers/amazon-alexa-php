<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities;

class Clear extends UpdateDynamicEntities
{
    public const UPDATE_BEHAVIOR = 'CLEAR';

    public static function create(): self
    {
        $directive = new static();

        $directive->type = static::TYPE;
        $directive->updateBehavior = static::UPDATE_BEHAVIOR;

        return $directive;
    }
}
