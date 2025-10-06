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

    /**
     * @param string|null $token Playback token
     * @param int|null $offsetInMilliseconds Playback offset in milliseconds
     * @param string|null $playerActivity Current player activity
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
