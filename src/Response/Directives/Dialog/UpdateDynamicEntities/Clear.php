<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities;

class Clear extends UpdateDynamicEntities
{
    public const UPDATE_BEHAVIOR = 'CLEAR';

    public function __construct()
    {
        parent::__construct(self::UPDATE_BEHAVIOR);
    }

    public static function create(): self
    {
        return new self();
    }
}
