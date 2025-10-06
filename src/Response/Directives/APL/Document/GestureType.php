<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum GestureType: string
{
    case DOUBLE_PRESS = 'DoublePress';
    case LONG_PRESS = 'LongPress';
    case SWIPE_AWAY = 'SwipeAway';
    case TAP = 'Tap';
}
