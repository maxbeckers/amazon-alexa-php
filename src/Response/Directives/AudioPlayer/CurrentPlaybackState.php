<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

class CurrentPlaybackState
{
    public const PLAYER_ACTIVITY_PLAYING = 'PLAYING';
    public const PLAYER_ACTIVITY_PAUSED = 'PAUSED';
    public const PLAYER_ACTIVITY_FINISHED = 'FINISHED';
    public const PLAYER_ACTIVITY_BUFFER_UNDERRUN = 'BUFFER_UNDERRUN';
    public const PLAYER_ACTIVITY_IDLE = 'IDLE';

    public string $token;
    public int $offsetInMilliseconds;
    public string $playerActivity;

    public static function create(string $token, int $offsetInMilliseconds, string $playerActivity): self
    {
        $currentPlaybackState = new self();

        $currentPlaybackState->token = $token;
        $currentPlaybackState->offsetInMilliseconds = $offsetInMilliseconds;
        $currentPlaybackState->playerActivity = $playerActivity;

        return $currentPlaybackState;
    }
}
