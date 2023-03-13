<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlaybackNearlyFinished extends AbstractPlaybackDirective
{
    const TYPE = 'AudioPlayer.PlaybackNearlyFinished';

    /**
     * @param string $requestId
     * @param string $timestamp
     * @param string $token
     * @param int    $offsetInMilliseconds
     * @param string $locale
     *
     * @return PlaybackNearlyFinished
     */
    public static function create(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale): self
    {
        $playbackNearlyFinished = new self();

        $playbackNearlyFinished->type = self::TYPE;
        $playbackNearlyFinished->setProperties($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);

        return $playbackNearlyFinished;
    }
}
