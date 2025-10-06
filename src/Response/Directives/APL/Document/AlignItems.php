<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum AlignItems: string
{
    case STRETCH = 'stretch';
    case CENTER = 'center';
    case START = 'start';
    case END = 'end';
    case BASELINE = 'baseline';
}
