<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum SwipeDirection: string
{
    case LEFT = 'left';
    case RIGHT = 'right';
    case UP = 'up';
    case DOWN = 'down';
    case FORWARD = 'forward';
    case BACKWARD = 'backward';
}
