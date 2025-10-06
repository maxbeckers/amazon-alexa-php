<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum SecureInputType: string
{
    case DECIMAL_PAD = 'decimalPad';
    case NORMAL = 'normal';
    case NUMBER_PAD = 'numberPad';
}
