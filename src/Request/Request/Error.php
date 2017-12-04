<?php

namespace MaxBeckers\AmazonAlexa\Request\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Error
{
    const TYPE_INVALID_RESPONSE                  = 'INVALID_RESPONSE';
    const TYPE_DEVICE_COMMUNICATION_ERROR        = 'DEVICE_COMMUNICATION_ERROR';
    const TYPE_INTERNAL_ERROR                    = 'INTERNAL_ERROR';
    const TYPE_MEDIA_ERROR_UNKNOWN               = 'MEDIA_ERROR_UNKNOWN';
    const TYPE_MEDIA_ERROR_INVALID_REQUEST       = 'MEDIA_ERROR_INVALID_REQUEST';
    const TYPE_MEDIA_ERROR_SERVICE_UNAVAILABLE   = 'MEDIA_ERROR_SERVICE_UNAVAILABLE';
    const TYPE_MEDIA_ERROR_INTERNAL_SERVER_ERROR = 'MEDIA_ERROR_INTERNAL_SERVER_ERROR';
    const TYPE_MEDIA_ERROR_INTERNAL_DEVICE_ERROR = 'MEDIA_ERROR_INTERNAL_DEVICE_ERROR';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $message;

    /**
     * @param array $amazonRequest
     *
     * @return Error
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $error = new self();

        $error->type    = $amazonRequest['type'];
        $error->message = $amazonRequest['message'];

        return $error;
    }
}
