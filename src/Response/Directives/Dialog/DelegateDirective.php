<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class DelegateDirective extends Directive
{
    const TYPE = 'Dialog.Delegate';

    /**
     * @var Intent|null
     */
    public $updatedIntent;

    /**
     * @param Intent $intent
     *
     * @return DelegateDirective
     */
    public static function create(Intent $intent): DelegateDirective
    {
        $delegateDirective = new self();

        $delegateDirective->type          = self::TYPE;
        $delegateDirective->updatedIntent = $intent;

        return $delegateDirective;
    }
}
