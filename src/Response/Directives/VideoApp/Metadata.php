<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\VideoApp;

class Metadata
{
    public function __construct(
        public ?string $title = null,
        public ?string $subtitle = null
    ) {
    }

    public static function create(?string $title = null, ?string $subtitle = null): self
    {
        return new self($title, $subtitle);
    }
}
