<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SkillEnabledRequest extends AlexaSkillEventRequest
{
    const TYPE = 'AlexaSkillEvent.SkillEnabled';

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
