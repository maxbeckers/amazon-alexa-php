<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\CanFulfill;

class CanFulfillIntentResponse
{
    public const CAN_FULFILL_YES = 'YES';
    public const CAN_FULFILL_MAYBE = 'MAYBE';
    public const CAN_FULFILL_NO = 'NO';

    /** @var CanFulfillSlot[] */
    public function __construct(
        public ?string $canFulfill = null,
        public array $slots = []
    ) {
    }

    public static function create(string $canFulfill, array $slots = []): self
    {
        return new self($canFulfill, $slots);
    }

    public function addSlot(string $slotName, CanFulfillSlot $canFulfillSlot): void
    {
        $this->slots[$slotName] = $canFulfillSlot;
    }
}
