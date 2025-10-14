<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class FinishCommand extends AbstractStandardCommand
{
    public const TYPE = 'Finish';

    public function __construct()
    {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize();
    }
}
