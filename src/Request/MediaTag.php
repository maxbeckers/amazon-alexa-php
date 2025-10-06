<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class MediaTag
{
    /**
     * @param bool|null $allowAdjustSeekPositionForward Whether seeking forward is allowed
     * @param bool|null $allowAdjustSeekPositionBackwards Whether seeking backwards is allowed
     * @param bool|null $allowNext Whether next track is allowed
     * @param bool|null $allowPrevious Whether previous track is allowed
     * @param AudioTrack|null $audioTrack Audio track type
     * @param Entity[]|null $entities Array of entities
     * @param bool|null $muted Whether audio is muted
     * @param int|null $positionInMilliseconds Current position in milliseconds
     * @param MediaState|null $state Current media state
     * @param string|null $url Media URL
     */
    public function __construct(
        public ?bool $allowAdjustSeekPositionForward = null,
        public ?bool $allowAdjustSeekPositionBackwards = null,
        public ?bool $allowNext = null,
        public ?bool $allowPrevious = null,
        public ?AudioTrack $audioTrack = null,
        public ?array $entities = null,
        public ?bool $muted = null,
        public ?int $positionInMilliseconds = null,
        public ?MediaState $state = null,
        public ?string $url = null,
    ) {
        $this->entities = $this->entities ?? [];
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $entities = [];
        if (isset($amazonRequest['entities']) && is_array($amazonRequest['entities'])) {
            foreach ($amazonRequest['entities'] as $entityData) {
                $entities[] = Entity::fromAmazonRequest($entityData);
            }
        }

        return new self(
            allowAdjustSeekPositionForward: $amazonRequest['allowAdjustSeekPositionForward'] ?? null,
            allowAdjustSeekPositionBackwards: $amazonRequest['allowAdjustSeekPositionBackwards'] ?? null,
            allowNext: $amazonRequest['allowNext'] ?? null,
            allowPrevious: $amazonRequest['allowPrevious'] ?? null,
            audioTrack: isset($amazonRequest['audioTrack']) ? AudioTrack::tryFrom($amazonRequest['audioTrack']) : null,
            entities: $entities,
            muted: $amazonRequest['muted'] ?? null,
            positionInMilliseconds: $amazonRequest['positionInMilliseconds'] ?? null,
            state: isset($amazonRequest['state']) ? MediaState::tryFrom($amazonRequest['state']) : null,
            url: $amazonRequest['url'] ?? null,
        );
    }
}
