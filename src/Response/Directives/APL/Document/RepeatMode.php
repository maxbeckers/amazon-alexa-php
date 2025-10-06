<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum RepeatMode: string
{
    case RESTART = 'restart';
    case REVERSE = 'reverse';
}
