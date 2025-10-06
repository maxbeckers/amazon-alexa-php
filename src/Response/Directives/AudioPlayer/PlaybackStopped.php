<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

class PlaybackStopped extends AbstractPlaybackDirective
{
    public const TYPE = 'AudioPlayer.PlaybackStopped';

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
     * @return PlaybackStopped
     */
    public static function create(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale): self
    {
        return new self($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);
    }
}
