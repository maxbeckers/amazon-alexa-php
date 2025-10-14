<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class SetLightDirective extends Directive
{
    public const TYPE = 'GadgetController.SetLight';

    public function __construct(
        public ?int $version = null,
        public array $targetGadgets = [],
        public ?Parameters $parameters = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(array $targetGadgets = [], ?Parameters $parameters = null, int $version = 1): self
    {
        return new self($version, $targetGadgets, $parameters);
    }
}
