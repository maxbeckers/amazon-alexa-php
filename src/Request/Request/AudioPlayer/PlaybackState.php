<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlaybackState
{
    const STATE_PLAYING         = 'PLAYING';
    const STATE_PAUSED          = 'PAUSED';
    const STATE_FINISHED        = 'FINISHED';
    const STATE_BUFFER_UNDERRUN = 'BUFFER_UNDERRUN';
    const STATE_IDLE            = 'IDLE';

    /**
     * @var string|null
     */
    public $token;

    /**
     * @var int|null
     */
    public $offsetInMilliseconds;

    /**
     * @var string|null
     */
    public $playerActivity;

    /**
     * @param array $amazonRequest
     *
     * @return PlaybackState
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $playbackState = new self();

        $playbackState->token                = PropertyHelper::checkNullValueString($amazonRequest, 'token');
        $playbackState->offsetInMilliseconds = PropertyHelper::checkNullValueInt($amazonRequest, 'offsetInMilliseconds');
        $playbackState->playerActivity       = PropertyHelper::checkNullValueString($amazonRequest, 'playerActivity');

        return $playbackState;
    }
}
