<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

class PlaybackFinished extends AbstractPlaybackDirective
{
    public const TYPE = 'AudioPlayer.PlaybackFinished';

    public function __construct(
        string $requestId = '',
        string $timestamp = '',
        string $token = '',
        int $offsetInMilliseconds = 0,
        string $locale = ''
    ) {
        parent::__construct($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);
        $this->type = self::TYPE;
    }

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
        return new self($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);
    }
}
