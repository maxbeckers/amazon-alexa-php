<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum HighlightMode: string
{
    case LINE = 'line';
    case BLOCK = 'block';
}
