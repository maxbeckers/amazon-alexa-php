<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class CardImage
{
    public function __construct(
        public ?string $smallImageUrl = null,
        public ?string $largeImageUrl = null
    ) {
    }

    public static function fromUrls(string $smallImageUrl, string $largeImageUrl): self
    {
        return new self($smallImageUrl, $largeImageUrl);
    }
}
