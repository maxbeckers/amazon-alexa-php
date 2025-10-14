<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class CurrentPlaybackState
{
    public const PLAYER_ACTIVITY_PLAYING = 'PLAYING';
    public const PLAYER_ACTIVITY_PAUSED = 'PAUSED';
    public const PLAYER_ACTIVITY_FINISHED = 'FINISHED';
    public const PLAYER_ACTIVITY_BUFFER_UNDERRUN = 'BUFFER_UNDERRUN';
    public const PLAYER_ACTIVITY_IDLE = 'IDLE';

    public function __construct(
        public string $token = '',
        public int $offsetInMilliseconds = 0,
        public string $playerActivity = ''
    ) {
    }

    public static function create(string $token, int $offsetInMilliseconds, string $playerActivity): self
    {
        return new self($token, $offsetInMilliseconds, $playerActivity);
    }
}
