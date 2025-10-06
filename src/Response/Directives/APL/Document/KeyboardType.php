<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum KeyboardType: string
{
    case DECIMAL_PAD = 'decimalPad';
    case NORMAL = 'normal';
    case NUMBER_PAD = 'numberPad';
    case EMAIL_ADDRESS = 'emailAddress';
    case PHONE_PAD = 'phonePad';
    case URL = 'url';
}
