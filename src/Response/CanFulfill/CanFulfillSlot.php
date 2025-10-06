<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\CanFulfill;

class CanFulfillSlot
{
    public const CAN_UNDERSTAND_YES = 'YES';
    public const CAN_UNDERSTAND_MAYBE = 'MAYBE';
    public const CAN_UNDERSTAND_NO = 'NO';
    public const CAN_FULFILL_YES = 'YES';
    public const CAN_FULFILL_NO = 'NO';

    public function __construct(
        public ?string $canUnderstand = null,
        public ?string $canFulfill = null
    ) {
    }

    public static function create(string $canUnderstand, string $canFulfill): self
    {
        return new self($canUnderstand, $canFulfill);
    }
}
