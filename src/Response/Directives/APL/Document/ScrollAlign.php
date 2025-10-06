<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum ScrollAlign: string
{
    case FIRST = 'first';
    case CENTER = 'center';
    case LAST = 'last';
    case VISIBLE = 'visible';
}
