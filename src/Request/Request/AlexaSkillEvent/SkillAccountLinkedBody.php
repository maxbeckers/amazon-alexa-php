<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class SkillAccountLinkedBody
{
    public ?string $accessToken = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $body = new self();

        $body->accessToken = PropertyHelper::checkNullValueString($amazonRequest, 'accessToken');

        return $body;
    }
}
