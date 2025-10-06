<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

class IdleCommand extends AbstractStandardCommand
{
    public const TYPE = 'Idle';

    public function __construct()
    {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize();
    }
}
