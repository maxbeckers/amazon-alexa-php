<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class ScrollableTag
{
    /**
     * @param ScrollDirection|null $direction Scroll direction
     * @param bool|null $allowForward Whether forward scrolling is allowed
     * @param bool|null $allowBackwards Whether backward scrolling is allowed
     */
    public function __construct(
        public ?ScrollDirection $direction = null,
        public ?bool $allowForward = null,
        public ?bool $allowBackwards = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            direction: isset($amazonRequest['direction']) ? ScrollDirection::tryFrom($amazonRequest['direction']) : null,
            allowForward: $amazonRequest['allowForward'] ?? null,
            allowBackwards: $amazonRequest['allowBackwards'] ?? null,
        );
    }
}
