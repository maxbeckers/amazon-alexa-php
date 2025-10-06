<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum AVGItemType: string
{
    case GROUP = 'group';
    case PATH = 'path';
    case TEXT = 'text';
}
