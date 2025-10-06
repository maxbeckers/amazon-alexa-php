<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

class Extension implements \JsonSerializable
{
    public function __construct(
        public string $name,
        public string $uri,
        public bool $required = false,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'uri' => $this->uri,
            'required' => $this->required,
        ];
    }
}
