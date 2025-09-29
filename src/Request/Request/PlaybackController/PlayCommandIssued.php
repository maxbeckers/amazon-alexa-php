<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\PlaybackController;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class PlayCommandIssued extends AbstractPlaybackController
{
    public const TYPE = 'PlaybackController.PlayCommandIssued';

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $playCommandIssued = new self();

        $playCommandIssued->type = self::TYPE;
        $playCommandIssued->setRequestData($amazonRequest);

        return $playCommandIssued;
    }
}
