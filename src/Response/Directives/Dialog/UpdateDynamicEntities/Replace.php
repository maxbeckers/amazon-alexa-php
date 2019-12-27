<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities;

use MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity\Type;

class Replace extends UpdateDynamicEntities
{
    const UPDATE_BEHAVIOR = 'REPLACE';

    /**
     * @var array | null
     */
    public $types;

    /**
     * @param Type $type
     */
    public function addType(Type $type)
    {
        $this->types[] = $type;
    }

    /**
     * @return Replace
     */
    public static function create(): self
    {
        $directive = new static();

        $directive->type           = self::TYPE;
        $directive->types          = [];
        $directive->updateBehavior = static::UPDATE_BEHAVIOR;

        return $directive;
    }
}
