<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum LayoutDirection: string
{
    case LTR = 'LTR';
    case RTL = 'RTL';
    case INHERIT = 'inherit';
}
