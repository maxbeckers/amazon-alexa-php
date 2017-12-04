<?php

namespace MaxBeckers\AmazonAlexa\Intent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Intent implements \JsonSerializable
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
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $intent = new self();

        $intent->name               = isset($amazonRequest['name']) ? $amazonRequest['name'] : null;
        $intent->confirmationStatus = isset($amazonRequest['confirmationStatus']) ? $amazonRequest['confirmationStatus'] : null;

        if (isset($amazonRequest['slots'])) {
            foreach ($amazonRequest['slots'] as $name => $slot) {
                $intent->slots[] = Slot::fromAmazonRequest($name, $slot);
            }
        }

        return $intent;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = [];

        $data['name'] = $this->name;
        if (null !== $this->confirmationStatus) {
            $data['confirmationStatus'] = $this->confirmationStatus;
        }

        if (!empty($this->slots)) {
            $data['slots'] = [];

            foreach ($this->slots as $slot) {
                $data['slots'][$slot->name] = $slot->jsonSerialize();
            }
        }

        return $data;
    }

    /**
     * @param $name
     *
     * @return null|Slot
     */
    public function getSlotByName($name)
    {
        foreach ($this->slots as $slot) {
            if ($slot->name === $name) {
                return $slot;
            }
        }

        return null;
    }
}
