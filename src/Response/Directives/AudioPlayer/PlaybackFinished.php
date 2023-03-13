<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlaybackFinished extends AbstractPlaybackDirective
{
    const TYPE = 'AudioPlayer.PlaybackFinished';

    /**
     * @param string $requestId
     * @param string $timestamp
     * @param string $token
     * @param int    $offsetInMilliseconds
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
