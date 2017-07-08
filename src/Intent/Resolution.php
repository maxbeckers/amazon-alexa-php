<?php

namespace MaxBeckers\AmazonAlexa\Intent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Resolution
{
    /**
     * @var string|null
     */
    public $authority;

    /**
     * @var string|null
     */
    public $value;

    /**
     * @var IntentStatus|null
     */
    public $confirmationStatus;

    /**
     * @var IntentValue[]
     */
    public $values = [];

    /**
     * @param array $amazonRequest
     *
     * @return Resolution
     */
    public static function fromAmazonRequest(array $amazonRequest): Resolution
    {
        $resolution = new self();

        $resolution->authority = isset($amazonRequest['authority']) ? $amazonRequest['authority'] : null;
        $resolution->status    = isset($amazonRequest['status']) ? IntentStatus::fromAmazonRequest($amazonRequest['status']) : null;

        if (isset($amazonRequest['values'])) {
            foreach ($amazonRequest['values'] as $value) {
                if (isset($value['value'])) {
                    $resolution->values[] = IntentValue::fromAmazonRequest($value['value']);
                }
            }
        }

        return $resolution;
    }
}
