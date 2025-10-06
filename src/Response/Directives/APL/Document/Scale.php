<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum Scale: string
{
    case BEST_FIT = 'best-fit';
    case BEST_FILL = 'best-fill';
    case BEST_FIT_DOWN = 'best-fit-down';
    case FILL = 'fill';
    case NONE = 'none';
}
