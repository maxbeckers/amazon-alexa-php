<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\System;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Error
{
    const MEDIA_ERROR_UNKNOWN               = 'MEDIA_ERROR_UNKNOWN';
    const MEDIA_ERROR_INVALID_REQUEST       = 'MEDIA_ERROR_INVALID_REQUEST';
    const MEDIA_ERROR_SERVICE_UNAVAILABLE   = 'MEDIA_ERROR_SERVICE_UNAVAILABLE';
    const MEDIA_ERROR_INTERNAL_SERVER_ERROR = 'MEDIA_ERROR_INTERNAL_SERVER_ERROR';
    const MEDIA_ERROR_INTERNAL_DEVICE_ERROR = 'MEDIA_ERROR_INTERNAL_DEVICE_ERROR';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $message;

    /**
     * @param string $type
     * @param string $message
     *
     * @return Error
     */
    public static function create(string $type, string $message): self
    {
        $error = new self();

        $error->type    = $type;
        $error->message = $message;

        return $error;
    }
}
