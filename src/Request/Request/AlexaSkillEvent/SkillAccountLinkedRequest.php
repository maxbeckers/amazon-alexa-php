<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SkillAccountLinkedRequest extends AlexaSkillEventRequest
{
    const TYPE = 'AlexaSkillEvent.SkillAccountLinked';

    /**
     * @var SkillAccountLinkedBody|null
     */
    public $body;

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->body = isset($amazonRequest['body']) ? SkillAccountLinkedBody::fromAmazonRequest($amazonRequest['body']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
