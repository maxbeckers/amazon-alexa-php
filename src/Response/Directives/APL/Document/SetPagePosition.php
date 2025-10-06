<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum SetPagePosition: string
{
    case RELATIVE = 'relative';
    case ABSOLUTE = 'absolute';
}
