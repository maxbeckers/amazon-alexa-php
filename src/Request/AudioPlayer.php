<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class AudioPlayer
{
    const PLAYER_ACTIVITY_IDLE            = 'IDLE';
    const PLAYER_ACTIVITY_PAUSED          = 'PAUSED';
    const PLAYER_ACTIVITY_PLAYING         = 'PLAYING';
    const PLAYER_ACTIVITY_BUFFER_UNDERRUN = 'BUFFER_UNDERRUN';
    const PLAYER_ACTIVITY_FINISHED        = 'FINISHED';
    const PLAYER_ACTIVITY_STOPPED         = 'STOPPED';

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
     * @return AudioPlayer
     */
    public static function fromAmazonRequest(array $amazonRequest): AudioPlayer
    {
        $audioPlayer = new self();

        $audioPlayer->token                = isset($amazonRequest['token']) ? $amazonRequest['token'] : null;
        $audioPlayer->offsetInMilliseconds = isset($amazonRequest['offsetInMilliseconds']) ? (int)$amazonRequest['offsetInMilliseconds'] : null;
        $audioPlayer->playerActivity       = isset($amazonRequest['playerActivity']) ? $amazonRequest['playerActivity'] : null;

        return $audioPlayer;
    }
}
