<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

enum AudioTrack: string
{
    case FOREGROUND = 'foreground';
    case BACKGROUND = 'background';
    case NONE = 'none';
}
