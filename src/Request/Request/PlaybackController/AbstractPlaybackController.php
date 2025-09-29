<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\PlaybackController;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

abstract class AbstractPlaybackController extends AbstractRequest
{
    public ?string $requestId = null;
    public ?string $locale = null;

    protected function setRequestData(array $amazonRequest): void
    {
        $this->setTime('timestamp', $amazonRequest['timestamp']);
        $this->requestId = $amazonRequest['requestId'] ?? null;
        $this->locale = $amazonRequest['locale'] ?? null;
    }
}
