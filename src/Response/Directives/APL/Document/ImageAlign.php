<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum ImageAlign: string
{
    case BOTTOM = 'bottom';
    case BOTTOM_LEFT = 'bottom-left';
    case BOTTOM_RIGHT = 'bottom-right';
    case CENTER = 'center';
    case LEFT = 'left';
    case RIGHT = 'right';
    case TOP = 'top';
    case TOP_LEFT = 'top-left';
    case TOP_RIGHT = 'top-right';
}
