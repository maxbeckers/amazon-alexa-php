<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class ElicitSlotDirective extends Directive
{
    public const TYPE = 'Dialog.ElicitSlot';

    public function __construct(
        public ?string $slotToElicit = null,
        public ?Intent $updatedIntent = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(string $slotToElicit, ?Intent $intent = null): self
    {
        return new self($slotToElicit, $intent);
    }
}
