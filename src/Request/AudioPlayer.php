<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class AudioPlayer
{
    public const PLAYER_ACTIVITY_IDLE = 'IDLE';
    public const PLAYER_ACTIVITY_PAUSED = 'PAUSED';
    public const PLAYER_ACTIVITY_PLAYING = 'PLAYING';
    public const PLAYER_ACTIVITY_BUFFER_UNDERRUN = 'BUFFER_UNDERRUN';
    public const PLAYER_ACTIVITY_FINISHED = 'FINISHED';
    public const PLAYER_ACTIVITY_STOPPED = 'STOPPED';

    /**
     * @param string|null $token Audio player token
     * @param int|null $offsetInMilliseconds Current playback offset in milliseconds
     * @param string|null $playerActivity Current player activity state
     */
    public function __construct(
        public ?string $token = null,
        public ?int $offsetInMilliseconds = null,
        public ?string $playerActivity = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            token: PropertyHelper::checkNullValueString($amazonRequest, 'token'),
            offsetInMilliseconds: PropertyHelper::checkNullValueInt($amazonRequest, 'offsetInMilliseconds'),
            playerActivity: PropertyHelper::checkNullValueString($amazonRequest, 'playerActivity'),
        );
    }
}
