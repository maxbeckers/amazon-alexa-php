<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Error;

class PlaybackFailedRequest extends AudioPlayerRequest
{
    public const TYPE = 'AudioPlayer.PlaybackFailed';

    public ?Error $error = null;
    public ?PlaybackState $currentPlaybackState = null;

    /**
     * {@inheritdoc}
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->error = isset($amazonRequest['error']) ? Error::fromAmazonRequest($amazonRequest['error']) : null;
        $request->currentPlaybackState = isset($amazonRequest['currentPlaybackState']) ? PlaybackState::fromAmazonRequest($amazonRequest['currentPlaybackState']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
