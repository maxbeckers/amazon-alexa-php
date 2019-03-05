<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\PlaybackController;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlayCommandIssued extends AbstractPlaybackController
{
    const TYPE = 'PlaybackController.PlayCommandIssued';

    /**
     * {@inheritdoc}
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $nextCommandIssued = new self();

        $nextCommandIssued->type = self::TYPE;

        $nextCommandIssued->setRequestData($amazonRequest);

        return $nextCommandIssued;
    }
}
