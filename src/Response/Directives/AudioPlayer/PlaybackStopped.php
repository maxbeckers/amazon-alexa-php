<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

class PlaybackStopped extends AbstractPlaybackDirective
{
    public const TYPE = 'AudioPlayer.PlaybackStopped';

    /**
     * @param string $requestId
     * @param string $timestamp
     * @param string $token
     * @param int $offsetInMilliseconds
     * @param string $locale
     *
     * @return PlaybackStopped
     */
    public static function create(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale): self
    {
        $playbackStopped = new self();

        $playbackStopped->type = self::TYPE;
        $playbackStopped->setProperties($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);

        return $playbackStopped;
    }
}
