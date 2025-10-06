<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum SubmitKeyType: string
{
    case DONE = 'done';
    case GO = 'go';
    case NEXT = 'next';
    case SEARCH = 'search';
    case SEND = 'send';
}
