<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ExportItem implements \JsonSerializable
{
    public function __construct(
        public string $name,
        public string $description = '',
    ) {
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'name' => $this->name,
            'description' => $this->description ?: null,
        ]);
    }
}
