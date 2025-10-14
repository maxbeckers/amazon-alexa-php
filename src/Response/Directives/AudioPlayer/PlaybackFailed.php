<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\System\Error;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class PlaybackFailed extends AbstractPlaybackDirective
{
    public const TYPE = 'AudioPlayer.PlaybackFailed';

    public function __construct(
        public ?Error $error = null,
        public ?CurrentPlaybackState $currentPlaybackState = null,
        string $requestId = '',
        string $timestamp = '',
        string $token = '',
        int $offsetInMilliseconds = 0,
        string $locale = ''
    ) {
        parent::__construct($requestId, $timestamp, $token, $offsetInMilliseconds, $locale);
        $this->type = self::TYPE;
    }

    public static function create(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale, Error $error, CurrentPlaybackState $currentPlaybackState): self
    {
        return new self($error, $currentPlaybackState, $requestId, $timestamp, $token, $offsetInMilliseconds, $locale);
    }
}
