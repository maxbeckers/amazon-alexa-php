<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

abstract class UpdateDynamicEntities extends Directive
{
    const TYPE = 'Dialog.UpdateDynamicEntities';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $updateBehavior;
}
