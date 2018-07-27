<?php

namespace MaxBeckers\AmazonAlexa\Response\CanFulfill;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class CanFulfillIntentResponse
{
    const CAN_FULFILL_YES   = 'YES';
    const CAN_FULFILL_MAYBE = 'MAYBE';
    const CAN_FULFILL_NO    = 'NO';
    /**
     * @var string|null
     */
    public $canFulfill;

    /**
     * @var CanFulfillSlot[]
     */
    public $slots = [];

    /**
     * @param string $canFulfill
     * @param array  $slots
     *
     * @return CanFulfillIntentResponse
     */
    public static function create(string $canFulfill, array $slots = []): self
    {
        $canFulfillIntentResponse = new self();

        $canFulfillIntentResponse->canFulfill = $canFulfill;
        $canFulfillIntentResponse->slots      = $slots;

        return $canFulfillIntentResponse;
    }

    /**
     * @param string         $slotName
     * @param CanFulfillSlot $canFulfillSlot
     */
    public function addSlot(string $slotName, CanFulfillSlot $canFulfillSlot)
    {
        $this->slots[$slotName] = $canFulfillSlot;
    }
}
