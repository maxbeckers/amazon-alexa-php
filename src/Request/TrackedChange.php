<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class TrackedChange
{
    /**
     * @param string|null $uid Unique identifier
     * @param string|null $name Name of the tracked change
     * @param MediaState|null $from Previous media state
     * @param MediaState|null $to New media state
     * @param string|null $utcTime UTC timestamp of the change
     */
    public function __construct(
        public ?string $uid = null,
        public ?string $name = null,
        public ?MediaState $from = null,
        public ?MediaState $to = null,
        public ?string $utcTime = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            uid: $amazonRequest['uid'] ?? null,
            name: $amazonRequest['name'] ?? null,
            from: isset($amazonRequest['from']) ? MediaState::tryFrom($amazonRequest['from']) : null,
            to: isset($amazonRequest['to']) ? MediaState::tryFrom($amazonRequest['to']) : null,
            utcTime: $amazonRequest['utcTime'] ?? null,
        );
    }
}
