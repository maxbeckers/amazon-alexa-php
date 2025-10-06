<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class ListTag
{
    /**
     * @param int|null $itemCount Total number of items in the list
     * @param int|null $highestIndexSeen Highest index seen
     * @param int|null $highestOrdinalSeen Highest ordinal seen
     * @param int|null $lowestIndexSeen Lowest index seen
     * @param int|null $lowestOrdinalSeen Lowest ordinal seen
     */
    public function __construct(
        public ?int $itemCount = null,
        public ?int $highestIndexSeen = null,
        public ?int $highestOrdinalSeen = null,
        public ?int $lowestIndexSeen = null,
        public ?int $lowestOrdinalSeen = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            itemCount: $amazonRequest['itemCount'] ?? null,
            highestIndexSeen: $amazonRequest['highestIndexSeen'] ?? null,
            highestOrdinalSeen: $amazonRequest['highestOrdinalSeen'] ?? null,
            lowestIndexSeen: $amazonRequest['lowestIndexSeen'] ?? null,
            lowestOrdinalSeen: $amazonRequest['lowestOrdinalSeen'] ?? null,
        );
    }
}
