<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;

abstract class MultiChildComponent extends APLBaseComponent
{
    use MultiChildComponentTrait;

    public function __construct(APLComponentType $type)
    {
        parent::__construct($type);
    }
}
