<?php

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

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
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $audioPlayer = new self();

        $audioPlayer->token                = PropertyHelper::checkNullValueString($amazonRequest, 'token');
        $audioPlayer->offsetInMilliseconds = PropertyHelper::checkNullValueInt($amazonRequest, 'offsetInMilliseconds');
        $audioPlayer->playerActivity       = PropertyHelper::checkNullValueString($amazonRequest, 'playerActivity');

        return $audioPlayer;
    }
}
