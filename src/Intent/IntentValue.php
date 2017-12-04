<?php

namespace MaxBeckers\AmazonAlexa\Intent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class IntentValue
{
    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string|null
     */
    public $id;

    /**
     * @param array $amazonRequest
     *
     * @return IntentValue
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $intentValue = new self();

        $intentValue->name = isset($amazonRequest['name']) ? $amazonRequest['name'] : null;
        $intentValue->id   = isset($amazonRequest['id']) ? $amazonRequest['id'] : null;

        return $intentValue;
    }
}
