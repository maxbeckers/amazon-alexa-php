<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum AudioTrack: string
{
    case FOREGROUND = 'foreground';
    case BACKGROUND = 'background';
    case NONE = 'none';
}
