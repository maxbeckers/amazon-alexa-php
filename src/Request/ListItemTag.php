<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class ListItemTag
{
    /**
     * @param int|null $index Index of the list item
     */
    public function __construct(
        public ?int $index = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            index: $amazonRequest['index'] ?? null,
        );
    }
}
