<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum TextAlign: string
{
    case AUTO = 'auto';
    case LEFT = 'left';
    case RIGHT = 'right';
    case CENTER = 'center';
    case START = 'start';
    case END = 'end';
}
