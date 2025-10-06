<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum ImportType: string
{
    case ALL_OF = 'allOf';
    case ONE_OF = 'oneOf';
}
