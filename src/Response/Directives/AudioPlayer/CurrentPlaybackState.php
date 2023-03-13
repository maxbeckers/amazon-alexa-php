<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class CurrentPlaybackState
{
    const PLAYER_ACTIVITY_PLAYING         = 'PLAYING';
    const PLAYER_ACTIVITY_PAUSED          = 'PAUSED';
    const PLAYER_ACTIVITY_FINISHED        = 'FINISHED';
    const PLAYER_ACTIVITY_BUFFER_UNDERRUN = 'BUFFER_UNDERRUN';
    const PLAYER_ACTIVITY_IDLE            = 'IDLE';

    /**
     * @var string
     */
    public $token;

    /**
     * @var int
     */
    public $offsetInMilliseconds;

    /**
     * @var string
     */
    public $playerActivity;

    /**
     * @param string $token
     * @param int    $offsetInMilliseconds
     * @param string $playerActivity
     *
     * @return CurrentPlaybackState
     */
    public static function create(string $token, int $offsetInMilliseconds, string $playerActivity): self
    {
        $currentPlaybackState = new self();

        $currentPlaybackState->token                = $token;
        $currentPlaybackState->offsetInMilliseconds = $offsetInMilliseconds;
        $currentPlaybackState->playerActivity       = $playerActivity;

        return $currentPlaybackState;
    }
}
