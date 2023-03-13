<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlaybackStopped extends AbstractPlaybackDirective
{
    const TYPE = 'AudioPlayer.PlaybackStopped';

    /**
     * @param string $requestId
     * @param string $timestamp
     * @param string $token
     * @param int    $offsetInMilliseconds
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
