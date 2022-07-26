<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlaybackStartedRequest extends AudioPlayerRequest
{
    const TYPE = 'AudioPlayer.PlaybackStarted';

    /**
     * @var int|null
     */
    public $offsetInMilliseconds;

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type                 = self::TYPE;
        $request->offsetInMilliseconds = isset($amazonRequest['offsetInMilliseconds']) ? $amazonRequest['offsetInMilliseconds'] : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
