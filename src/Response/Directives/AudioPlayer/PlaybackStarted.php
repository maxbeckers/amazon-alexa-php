<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlaybackStarted extends AbstractPlaybackDirective
{
    const TYPE = 'AudioPlayer.PlaybackStarted';

    /**
     * @param string $requestId
     * @param string $timestamp
     * @param string $token
     * @param int    $offsetInMilliseconds
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
