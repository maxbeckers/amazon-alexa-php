<?php

namespace MaxBeckers\AmazonAlexa\Response\CanFulfill;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class CanFulfillSlot
{
    const CAN_UNDERSTAND_YES   = 'YES';
    const CAN_UNDERSTAND_MAYBE = 'MAYBE';
    const CAN_UNDERSTAND_NO    = 'NO';
    const CAN_FULFILL_YES      = 'YES';
    const CAN_FULFILL_NO       = 'NO';

    /**
     * @var string|null
     */
    public $canUnderstand;

    /**
     * @var string|null
     */
    public $canFulfill;

    /**
     * @param string $canUnderstand
     * @param string $canFulfill
     *
     * @return CanFulfillSlot
     */
    public static function create(string $canUnderstand, string $canFulfill): self
    {
        $slot = new self();

        $slot->canUnderstand = $canUnderstand;
        $slot->canFulfill    = $canFulfill;

        return $slot;
    }
}
