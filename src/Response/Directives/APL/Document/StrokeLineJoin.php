<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum StrokeLineJoin: string
{
    case BEVEL = 'bevel';
    case MITER = 'miter';
    case ROUND = 'round';
}
