<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives;

abstract class Directive
{
    public function __construct(
        public string $type = ''
    ) {
    }
}
