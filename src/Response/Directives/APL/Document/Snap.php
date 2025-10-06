<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum Snap: string
{
    case NONE = 'none';
    case START = 'start';
    case CENTER = 'center';
    case END = 'end';
    case FORCE_START = 'forceStart';
    case FORCE_CENTER = 'forceCenter';
    case FORCE_END = 'forceEnd';
}
