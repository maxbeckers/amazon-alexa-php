<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ConfirmIntentDirective extends Directive
{
    const TYPE = 'Dialog.ConfirmIntent';

    /**
     * @var Intent|null
     */
    public $updatedIntent;

    /**
     * @param Intent|null $intent
     *
     * @return ConfirmIntentDirective
     */
    public static function create(Intent $intent = null): self
    {
        $confirmIntentDirective = new self();

        $confirmIntentDirective->type          = self::TYPE;
        $confirmIntentDirective->updatedIntent = $intent;

        return $confirmIntentDirective;
    }
}
