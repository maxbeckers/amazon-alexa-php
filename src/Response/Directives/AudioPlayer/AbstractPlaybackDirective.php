<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

abstract class AbstractPlaybackDirective extends Directive
{
    public function __construct(
        public string $requestId = '',
        public string $timestamp = '',
        public string $token = '',
        public int $offsetInMilliseconds = 0,
        public string $locale = ''
    ) {
        parent::__construct();
    }
}
