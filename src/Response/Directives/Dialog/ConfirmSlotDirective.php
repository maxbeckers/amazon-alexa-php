<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class ConfirmSlotDirective extends Directive
{
    public const TYPE = 'Dialog.ConfirmSlot';

    public ?string $slotToConfirm = null;
    public ?Intent $updatedIntent = null;

    public static function create(string $slotToConfirm, ?Intent $intent = null): self
    {
        $confirmSlotDirective = new self();

        $confirmSlotDirective->type = self::TYPE;
        $confirmSlotDirective->slotToConfirm = $slotToConfirm;
        $confirmSlotDirective->updatedIntent = $intent;

        return $confirmSlotDirective;
    }
}
