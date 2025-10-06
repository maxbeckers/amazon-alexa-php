<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

enum ScrollDirection: string
{
    case HORIZONTAL = 'horizontal';
    case VERTICAL = 'vertical';
}
