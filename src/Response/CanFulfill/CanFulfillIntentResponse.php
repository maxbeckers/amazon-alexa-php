<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\CanFulfill;

class CanFulfillIntentResponse
{
    public const CAN_FULFILL_YES = 'YES';
    public const CAN_FULFILL_MAYBE = 'MAYBE';
    public const CAN_FULFILL_NO = 'NO';

    public ?string $canFulfill = null;

    /** @var CanFulfillSlot[] */
    public array $slots = [];

    public static function create(string $canFulfill, array $slots = []): self
    {
        $canFulfillIntentResponse = new self();

        $canFulfillIntentResponse->canFulfill = $canFulfill;
        $canFulfillIntentResponse->slots = $slots;

        return $canFulfillIntentResponse;
    }

    public function addSlot(string $slotName, CanFulfillSlot $canFulfillSlot): void
    {
        $this->slots[$slotName] = $canFulfillSlot;
    }
}
