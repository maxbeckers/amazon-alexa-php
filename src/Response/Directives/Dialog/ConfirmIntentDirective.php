<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class ConfirmIntentDirective extends Directive
{
    public const TYPE = 'Dialog.ConfirmIntent';

    public ?Intent $updatedIntent = null;

    public static function create(?Intent $intent = null): self
    {
        $confirmIntentDirective = new self();

        $confirmIntentDirective->type = self::TYPE;
        $confirmIntentDirective->updatedIntent = $intent;

        return $confirmIntentDirective;
    }
}
