<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

class ListItem
{
    public function __construct(
        public ?string $token = null,
        public ?Image $image = null,
        public ?TextContent $textContent = null
    ) {
    }

    public static function create(?string $token = null, ?Image $image = null, ?TextContent $textContent = null): self
    {
        return new self($token, $image, $textContent);
    }
}
