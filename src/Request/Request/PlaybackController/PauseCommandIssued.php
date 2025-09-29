<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\PlaybackController;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class PauseCommandIssued extends AbstractPlaybackController
{
    public const TYPE = 'PlaybackController.PauseCommandIssued';

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $pauseCommandIssued = new self();

        $pauseCommandIssued->type = self::TYPE;
        $pauseCommandIssued->setRequestData($amazonRequest);

        return $pauseCommandIssued;
    }
}
