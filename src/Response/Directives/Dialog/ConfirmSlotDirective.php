<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ConfirmSlotDirective extends Directive
{
    public const TYPE = 'Dialog.ConfirmSlot';

    public function __construct(
        public ?string $slotToConfirm = null,
        public ?Intent $updatedIntent = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(string $slotToConfirm, ?Intent $intent = null): self
    {
        return new self($slotToConfirm, $intent);
    }
}
