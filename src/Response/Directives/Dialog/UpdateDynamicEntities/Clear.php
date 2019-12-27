<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities;

class Clear extends UpdateDynamicEntities
{
    const UPDATE_BEHAVIOR = 'CLEAR';

    /**
     * @return Clear
     */
    public static function create(): self
    {
        $directive = new static();

        $directive->type           = static::TYPE;
        $directive->updateBehavior = static::UPDATE_BEHAVIOR;

        return $directive;
    }
}
