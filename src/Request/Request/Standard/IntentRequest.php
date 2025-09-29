<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\Standard;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class IntentRequest extends StandardRequest
{
    public const DIALOG_STATE_STARTED = 'STARTED';
    public const DIALOG_STATE_IN_PROGRESS = 'IN_PROGRESS';
    public const DIALOG_STATE_COMPLETED = 'COMPLETED';

    public const TYPE = 'IntentRequest';

    public ?string $dialogState = null;
    public ?Intent $intent = null;

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new static();

        $request->type = static::TYPE;
        $request->dialogState = PropertyHelper::checkNullValueString($amazonRequest, 'dialogState');
        $request->intent = Intent::fromAmazonRequest($amazonRequest['intent']);
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
