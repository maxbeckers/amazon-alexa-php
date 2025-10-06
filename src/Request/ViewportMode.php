<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

enum ViewportMode: string
{
    case AUTO = 'AUTO';
    case HUB = 'HUB';
    case MOBILE = 'MOBILE';
    case PC = 'PC';
    case TV = 'TV';
}
