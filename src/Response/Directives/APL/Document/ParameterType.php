<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum ParameterType: string
{
    case ANY = 'any';
    case ARRAY = 'array';
    case BOOLEAN = 'boolean';
    case COLOR = 'color';
    case DIMENSION = 'dimension';
    case INTEGER = 'integer';
    case MAP = 'map';
    case NUMBER = 'number';
    case OBJECT = 'object';
    case STRING = 'string';
}
