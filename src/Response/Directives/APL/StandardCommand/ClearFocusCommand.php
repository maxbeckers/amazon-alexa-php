<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ClearFocusCommand extends AbstractStandardCommand
{
    public const TYPE = 'ClearFocus';

    public function __construct()
    {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize();
    }
}
