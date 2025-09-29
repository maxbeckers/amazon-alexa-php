<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\Standard;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

abstract class StandardRequest extends AbstractRequest
{
    public ?string $token = null;
    public string $requestId;
    public string $locale;

    protected function setRequestData(array $amazonRequest): void
    {
        $this->requestId = $amazonRequest['requestId'];
        $this->setTime('timestamp', $amazonRequest['timestamp']);
        $this->locale = $amazonRequest['locale'];
    }
}
