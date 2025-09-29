<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class ConnectionsResponseRequest extends SystemRequest
{
    public const TYPE = 'Connections.Response';
    public const NAME_UPSELL = 'Upsell';
    public const NAME_BUY = 'Buy';
    public const NAME_CANCEL = 'CANCEL';

    public ?string $name = null;
    public ?string $token = null;
    public ?Status $status = null;
    public ?Payload $payload = null;

    /**
     * {@inheritdoc}
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->name = PropertyHelper::checkNullValueString($amazonRequest, 'name');
        $request->token = PropertyHelper::checkNullValueString($amazonRequest, 'token');
        $request->status = isset($amazonRequest['status']) ? Status::fromAmazonRequest($amazonRequest['status']) : null;
        $request->payload = isset($amazonRequest['payload']) ? Payload::fromAmazonRequest($amazonRequest['payload']) : null;

        $request->setRequestData($amazonRequest);

        return $request;
    }
}
