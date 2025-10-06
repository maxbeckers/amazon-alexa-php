<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum Direction: string
{
    case COLUMN = 'column';
    case ROW = 'row';
    case COLUMN_REVERSE = 'columnReverse';
    case ROW_REVERSE = 'rowReverse';
}
