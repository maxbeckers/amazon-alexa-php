<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum BindType: string
{
    case ANY = 'any';
    case BOOLEAN = 'boolean';
    case STRING = 'string';
    case NUMBER = 'number';
    case DIMENSION = 'dimension';
    case COLOR = 'color';
}
