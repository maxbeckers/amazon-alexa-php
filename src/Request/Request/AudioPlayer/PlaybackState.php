<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class PlaybackState
{
    public const STATE_PLAYING = 'PLAYING';
    public const STATE_PAUSED = 'PAUSED';
    public const STATE_FINISHED = 'FINISHED';
    public const STATE_BUFFER_UNDERRUN = 'BUFFER_UNDERRUN';
    public const STATE_IDLE = 'IDLE';

    public ?string $token = null;
    public ?int $offsetInMilliseconds = null;
    public ?string $playerActivity = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $playbackState = new self();

        $playbackState->token = PropertyHelper::checkNullValueString($amazonRequest, 'token');
        $playbackState->offsetInMilliseconds = PropertyHelper::checkNullValueInt($amazonRequest, 'offsetInMilliseconds');
        $playbackState->playerActivity = PropertyHelper::checkNullValueString($amazonRequest, 'playerActivity');

        return $playbackState;
    }
}
