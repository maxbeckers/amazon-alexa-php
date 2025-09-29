<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\System\Error;

class PlaybackFailed extends AbstractPlaybackDirective
{
    public const TYPE = 'AudioPlayer.PlaybackFailed';

    public Error $error;
    public CurrentPlaybackState $currentPlaybackState;

    public static function create(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale, Error $error, CurrentPlaybackState $currentPlaybackState): self
    {
        $playbackFailed = new self();

        $playbackFailed->type = self::TYPE;
        $playbackFailed->error = $error;
        $playbackFailed->currentPlaybackState = $currentPlaybackState;
        $playbackFailed->setProperties($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);

        return $playbackFailed;
    }
}
