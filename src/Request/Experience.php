<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Experience
{
    /**
     * @param string|int|null $arcMinuteWidth Arc minute width
     * @param string|int|null $arcMinuteHeight Arc minute height
     * @param bool|null $canRotate Whether the experience can rotate
     * @param bool|null $canResize Whether the experience can resize
     */
    public function __construct(
        public string|int|null $arcMinuteWidth = null,
        public string|int|null $arcMinuteHeight = null,
        public ?bool $canRotate = null,
        public ?bool $canResize = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            arcMinuteWidth: $amazonRequest['arcMinuteWidth'] ?? null,
            arcMinuteHeight: $amazonRequest['arcMinuteHeight'] ?? null,
            canRotate: $amazonRequest['canRotate'] ?? null,
            canResize: $amazonRequest['canResize'] ?? null,
        );
    }
}
