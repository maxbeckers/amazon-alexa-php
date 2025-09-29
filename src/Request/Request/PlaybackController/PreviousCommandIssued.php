<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\PlaybackController;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class PreviousCommandIssued extends AbstractPlaybackController
{
    public const TYPE = 'PlaybackController.PreviousCommandIssued';

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $previousCommandIssued = new self();

        $previousCommandIssued->type = self::TYPE;
        $previousCommandIssued->setRequestData($amazonRequest);

        return $previousCommandIssued;
    }
}
