<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

abstract class Recognizer
{
    public function __construct(
        public string $type = ''
    ) {
    }
}
