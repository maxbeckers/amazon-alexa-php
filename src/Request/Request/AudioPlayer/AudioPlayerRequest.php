<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

abstract class AudioPlayerRequest extends AbstractRequest
{
    public ?string $token;
    public string $requestId;
    public string $locale;

    protected function setRequestData(array $amazonRequest): void
    {
        $this->requestId = $amazonRequest['requestId'];
        $this->setTime('timestamp', $amazonRequest['timestamp']);
        $this->locale = $amazonRequest['locale'];
        $this->token = PropertyHelper::checkNullValueString($amazonRequest, 'token');
    }
}
