<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SkillAccountLinkedBody
{
    /**
     * @var string|null
     */
    public $accessToken;

    /**
     * @param array $amazonRequest
     *
     * @return SkillAccountLinkedBody
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $body = new self();

        $body->accessToken = isset($amazonRequest['accessToken']) ? $amazonRequest['accessToken'] : null;

        return $body;
    }
}
