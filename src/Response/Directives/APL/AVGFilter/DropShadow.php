<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGFilter;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGFilterType;

class DropShadow extends AVGFilter implements \JsonSerializable
{
    public const TYPE = AVGFilterType::DROP_SHADOW;

    /**
     * @param string|null $color Color of the drop shadow
     * @param int|null $horizontalOffset Horizontal offset of the shadow
     * @param int|null $radius Blur radius of the shadow
     * @param int|null $verticalOffset Vertical offset of the shadow
     */
    public function __construct(
        public ?string $color = null,
        public ?int $horizontalOffset = null,
        public ?int $radius = null,
        public ?int $verticalOffset = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->color !== null) {
            $data['color'] = $this->color;
        }

        if ($this->horizontalOffset !== null) {
            $data['horizontalOffset'] = $this->horizontalOffset;
        }

        if ($this->radius !== null) {
            $data['radius'] = $this->radius;
        }

        if ($this->verticalOffset !== null) {
            $data['verticalOffset'] = $this->verticalOffset;
        }

        return $data;
    }
}
