<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum ScaleType: string
{
    case NONE = 'none';
    case GROW = 'grow';
    case SHRINK = 'shrink';
    case STRETCH = 'stretch';
}
