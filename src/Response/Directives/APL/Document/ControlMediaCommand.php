<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum ControlMediaCommand: string
{
    case PLAY = 'play';
    case PAUSE = 'pause';
    case NEXT = 'next';
    case PREVIOUS = 'previous';
    case REWIND = 'rewind';
    case SEEK = 'seek';
    case SEEK_TO = 'seekTo';
    case SET_TRACK = 'setTrack';
}
