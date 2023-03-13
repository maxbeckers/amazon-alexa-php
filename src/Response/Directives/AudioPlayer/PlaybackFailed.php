<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\System\Error;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlaybackFailed extends AbstractPlaybackDirective
{
    const TYPE = 'AudioPlayer.PlaybackFailed';

    /**
     * @var Error
     */
    public $error;

    /**
     * @var CurrentPlaybackState
     */
    public $currentPlaybackState;

    /**
     * @param string               $requestId
     * @param string               $timestamp
     * @param string               $token
     * @param int                  $offsetInMilliseconds
     * @param string               $locale
     * @param Error                $error
     * @param CurrentPlaybackState $currentPlaybackState
     *
     * @return PlaybackFailed
     */
    public static function create(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale, Error $error, CurrentPlaybackState $currentPlaybackState): self
    {
        $playbackFailed = new self();

        $playbackFailed->type                 = self::TYPE;
        $playbackFailed->error                = $error;
        $playbackFailed->currentPlaybackState = $currentPlaybackState;
        $playbackFailed->setProperties($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);

        return $playbackFailed;
    }
}
