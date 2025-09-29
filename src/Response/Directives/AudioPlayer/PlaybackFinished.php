<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

class PlaybackFinished extends AbstractPlaybackDirective
{
    public const TYPE = 'AudioPlayer.PlaybackFinished';

    /**
     * @param string $requestId
     * @param string $timestamp
     * @param string $token
     * @param int $offsetInMilliseconds
     * @param string $locale
     *
     * @return PlaybackFinished
     */
    public static function create(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale): self
    {
        $playbackFinished = new self();

        $playbackFinished->type = self::TYPE;
        $playbackFinished->setProperties($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);

        return $playbackFinished;
    }
}
