<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class DelegateDirective extends Directive
{
    public const TYPE = 'Dialog.Delegate';

    public function __construct(
        public ?Intent $updatedIntent = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(?Intent $intent = null): self
    {
        return new self($intent);
    }
}
