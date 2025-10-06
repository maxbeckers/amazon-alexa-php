<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\System;

class Error
{
    public const MEDIA_ERROR_UNKNOWN = 'MEDIA_ERROR_UNKNOWN';
    public const MEDIA_ERROR_INVALID_REQUEST = 'MEDIA_ERROR_INVALID_REQUEST';
    public const MEDIA_ERROR_SERVICE_UNAVAILABLE = 'MEDIA_ERROR_SERVICE_UNAVAILABLE';
    public const MEDIA_ERROR_INTERNAL_SERVER_ERROR = 'MEDIA_ERROR_INTERNAL_SERVER_ERROR';
    public const MEDIA_ERROR_INTERNAL_DEVICE_ERROR = 'MEDIA_ERROR_INTERNAL_DEVICE_ERROR';

    public function __construct(
        public string $type = '',
        public string $message = ''
    ) {
    }

    public static function create(string $type, string $message): self
    {
        return new self($type, $message);
    }
}
