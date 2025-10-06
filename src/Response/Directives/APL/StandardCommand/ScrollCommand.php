<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

class ScrollCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'Scroll';

    /**
     * @param string|null $componentId ID of the component to scroll
     * @param int|null $distance Distance to scroll in pixels
     * @param int|null $targetDuration Duration of the scroll animation in milliseconds
     */
    public function __construct(
        public ?string $componentId = null,
        public ?int $distance = null,
        public ?int $targetDuration = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->distance !== null) {
            $data['distance'] = $this->distance;
        }

        if ($this->targetDuration !== null) {
            $data['targetDuration'] = $this->targetDuration;
        }

        return $data;
    }
}
