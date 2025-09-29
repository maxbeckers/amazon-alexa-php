<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

abstract class AbstractPlaybackDirective extends Directive
{
    public string $requestId;
    public string $timestamp;
    public string $token;
    public int $offsetInMilliseconds;
    public string $locale;

    public function setProperties(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale): void
    {
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
        $this->token = $token;
        $this->offsetInMilliseconds = $offsetInMilliseconds;
        $this->locale = $locale;
    }
}
