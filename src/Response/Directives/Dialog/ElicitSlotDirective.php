<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class ElicitSlotDirective extends Directive
{
    public const TYPE = 'Dialog.ElicitSlot';

    public ?string $slotToElicit = null;
    public ?Intent $updatedIntent = null;

    public static function create(string $slotToElicit, ?Intent $intent = null): self
    {
        $elicitSlotDirective = new self();

        $elicitSlotDirective->type = self::TYPE;
        $elicitSlotDirective->slotToElicit = $slotToElicit;
        $elicitSlotDirective->updatedIntent = $intent;

        return $elicitSlotDirective;
    }
}
