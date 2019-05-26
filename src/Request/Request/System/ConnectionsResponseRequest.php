<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Charlie Root <charlie@chrl.ru>
 */
class ConnectionsResponseRequest extends SystemRequest
{
    const TYPE = 'Connections.Response';


    /**
     * {@inheritdoc}
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;

        $request->setRequestData($amazonRequest);

        return $request;
    }
}
