<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Error;

class PlaybackFailedRequest extends AudioPlayerRequest
{
    public const TYPE = 'AudioPlayer.PlaybackFailed';

    /**
     * @param \DateTime|null $timestamp Request timestamp
     * @param string|null $token Audio player token
     * @param string|null $requestId Request identifier
     * @param string|null $locale Request locale
     * @param Error|null $error Error information
     * @param PlaybackState|null $currentPlaybackState Current playback state
     */
    public function __construct(
        ?\DateTime $timestamp = null,
        ?string $token = null,
        ?string $requestId = null,
        ?string $locale = null,
        public ?Error $error = null,
        public ?PlaybackState $currentPlaybackState = null,
    ) {
        parent::__construct(
            type: self::TYPE,
            timestamp: $timestamp,
            token: $token,
            requestId: $requestId,
            locale: $locale
        );
    }

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        return new self(
            timestamp: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'timestamp')),
            token: PropertyHelper::checkNullValueString($amazonRequest, 'token'),
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
            locale: PropertyHelper::checkNullValueString($amazonRequest, 'locale'),
            error: isset($amazonRequest['error']) ? Error::fromAmazonRequest($amazonRequest['error']) : null,
            currentPlaybackState: isset($amazonRequest['currentPlaybackState']) ? PlaybackState::fromAmazonRequest($amazonRequest['currentPlaybackState']) : null,
        );
    }
}
