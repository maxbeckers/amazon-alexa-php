<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

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
    public static function fromAmazonRequest(array $amazonRequest): PlaybackState
    {
        $playbackState = new self();

        $playbackState->token                = isset($amazonRequest['token']) ? $amazonRequest['token'] : null;
        $playbackState->offsetInMilliseconds = isset($amazonRequest['offsetInMilliseconds']) ? $amazonRequest['offsetInMilliseconds'] : null;
        $playbackState->playerActivity       = isset($amazonRequest['playerActivity']) ? $amazonRequest['playerActivity'] : null;

        return $playbackState;
    }
}
