<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\Standard;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class IntentRequest extends StandardRequest
{
    const DIALOG_STATE_STARTED     = 'STARTED';
    const DIALOG_STATE_IN_PROGRESS = 'IN_PROGRESS';
    const DIALOG_STATE_COMPLETED   = 'COMPLETED';

    const TYPE = 'IntentRequest';

    /**
     * @var string|null
     */
    public $dialogState;

    /**
     * @var Intent|null
     */
    public $intent;

    /**
     * {@inheritdoc}
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type        = self::TYPE;
        $request->dialogState = isset($amazonRequest['dialogState']) ? $amazonRequest['dialogState'] : null;
        $request->intent      = Intent::fromAmazonRequest($amazonRequest['intent']);
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
