<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class ViewportTag
{
    /**
     * @param string|null $utcTime UTC timestamp
     * @param int|null $elapsedTime Elapsed time
     * @param TrackedChange[]|null $trackedChanges Array of tracked changes
     */
    public function __construct(
        public ?string $utcTime = null,
        public ?int $elapsedTime = null,
        public ?array $trackedChanges = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $trackedChanges = null;
        if (isset($amazonRequest['trackedChanges']) && is_array($amazonRequest['trackedChanges'])) {
            $trackedChanges = [];
            foreach ($amazonRequest['trackedChanges'] as $trackedChangeData) {
                $trackedChanges[] = TrackedChange::fromAmazonRequest($trackedChangeData);
            }
        }

        return new self(
            utcTime: $amazonRequest['utcTime'] ?? null,
            elapsedTime: $amazonRequest['elapsedTime'] ?? null,
            trackedChanges: $trackedChanges,
        );
    }
}
