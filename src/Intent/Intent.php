<?php

namespace MaxBeckers\AmazonAlexa\Intent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Intent
{
    const STATUS_NONE      = 'NONE';
    const STATUS_CONFIRMED = 'CONFIRMED';
    const STATUS_DENIED    = 'DENIED';

    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string|null
     */
    public $confirmationStatus;

    /**
     * @var Slot[]
     */
    public $slots = [];

    /**
     * @param array $amazonRequest
     *
     * @return Intent
     */
    public static function fromAmazonRequest(array $amazonRequest): Intent
    {
        $intent = new self();

        $intent->name               = isset($amazonRequest['name']) ? $amazonRequest['name'] : null;
        $intent->confirmationStatus = isset($amazonRequest['confirmationStatus']) ? $amazonRequest['confirmationStatus'] : null;

        foreach ($amazonRequest['slots'] as $name => $slot) {
            $intent->slots[] = Slot::fromAmazonRequest($name, $slot);
        }

        return $intent;
    }
}
