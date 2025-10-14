<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\VideoApp;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class VideoItem
{
    public function __construct(
        public ?string $source = null,
        public ?Metadata $metadata = null
    ) {
    }

    public static function create(string $source, ?Metadata $metadata = null): self
    {
        return new self($source, $metadata);
    }
}
