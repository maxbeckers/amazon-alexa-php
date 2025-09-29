<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class DelegateDirective extends Directive
{
    public const TYPE = 'Dialog.Delegate';

    public ?Intent $updatedIntent = null;

    public static function create(?Intent $intent = null): self
    {
        $delegateDirective = new self();

        $delegateDirective->type = self::TYPE;
        $delegateDirective->updatedIntent = $intent;

        return $delegateDirective;
    }
}
