<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;

abstract class ActionableComponent extends APLBaseComponent implements \JsonSerializable
{
    use ActionableComponentTrait;

    public function __construct(APLComponentType $type, ?array $preserve = null)
    {
        parent::__construct(type: $type, preserve: $preserve);
    }

    public function jsonSerialize(): array
    {
        return array_merge(
            parent::jsonSerialize(),
            $this->serializeActionableProperties()
        );
    }
}
