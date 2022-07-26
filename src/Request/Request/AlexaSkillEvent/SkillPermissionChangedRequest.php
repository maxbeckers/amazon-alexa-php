<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SkillPermissionChangedRequest extends AlexaSkillEventRequest
{
    const TYPE = 'AlexaSkillEvent.SkillPermissionChanged';

    /**
     * @var SkillPermissionBody|null
     */
    public $body;

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->body = isset($amazonRequest['body']) ? SkillPermissionBody::fromAmazonRequest($amazonRequest['body']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
