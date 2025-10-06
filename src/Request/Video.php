<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Video
{
    /**
     * @param string[]|null $codecs Array of supported video codecs
     */
    public function __construct(
        public ?array $codecs = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            codecs: $amazonRequest['codecs'] ?? null,
        );
    }
}
