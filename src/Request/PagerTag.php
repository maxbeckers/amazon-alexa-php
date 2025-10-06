<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class PagerTag
{
    /**
     * @param int|null $index Current page index
     * @param int|null $pageCount Total number of pages
     * @param bool|null $allowForward Whether forward navigation is allowed
     * @param bool|null $allowBackwards Whether backward navigation is allowed
     */
    public function __construct(
        public ?int $index = null,
        public ?int $pageCount = null,
        public ?bool $allowForward = null,
        public ?bool $allowBackwards = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            index: $amazonRequest['index'] ?? null,
            pageCount: $amazonRequest['pageCount'] ?? null,
            allowForward: $amazonRequest['allowForward'] ?? null,
            allowBackwards: $amazonRequest['allowBackwards'] ?? null,
        );
    }
}
