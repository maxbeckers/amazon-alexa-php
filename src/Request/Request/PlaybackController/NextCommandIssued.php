<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\PlaybackController;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class NextCommandIssued extends AbstractPlaybackController
{
    public const TYPE = 'PlaybackController.NextCommandIssued';

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $nextCommandIssued = new self();

        $nextCommandIssued->type = self::TYPE;
        $nextCommandIssued->setRequestData($amazonRequest);

        return $nextCommandIssued;
    }
}
