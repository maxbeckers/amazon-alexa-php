<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request;

class Error
{
    public const TYPE_INVALID_RESPONSE = 'INVALID_RESPONSE';
    public const TYPE_DEVICE_COMMUNICATION_ERROR = 'DEVICE_COMMUNICATION_ERROR';
    public const TYPE_INTERNAL_ERROR = 'INTERNAL_ERROR';
    public const TYPE_MEDIA_ERROR_UNKNOWN = 'MEDIA_ERROR_UNKNOWN';
    public const TYPE_MEDIA_ERROR_INVALID_REQUEST = 'MEDIA_ERROR_INVALID_REQUEST';
    public const TYPE_MEDIA_ERROR_SERVICE_UNAVAILABLE = 'MEDIA_ERROR_SERVICE_UNAVAILABLE';
    public const TYPE_MEDIA_ERROR_INTERNAL_SERVER_ERROR = 'MEDIA_ERROR_INTERNAL_SERVER_ERROR';
    public const TYPE_MEDIA_ERROR_INTERNAL_DEVICE_ERROR = 'MEDIA_ERROR_INTERNAL_DEVICE_ERROR';

    /**
     * @param string $type Error type
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public string $message,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            type: $amazonRequest['type'],
            message: $amazonRequest['message'],
        );
    }
}
