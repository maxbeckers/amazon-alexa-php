<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

class PlaybackStarted extends AbstractPlaybackDirective
{
    public const TYPE = 'AudioPlayer.PlaybackStarted';

    /**
     * @param string $requestId
     * @param string $timestamp
     * @param string $token
     * @param int $offsetInMilliseconds
     * @param string $locale
     *
     * @return PlaybackStarted
     */
    public static function create(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale): self
    {
        $playbackStarted = new self();

        $playbackStarted->type = self::TYPE;
        $playbackStarted->setProperties($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);

        return $playbackStarted;
    }
}
