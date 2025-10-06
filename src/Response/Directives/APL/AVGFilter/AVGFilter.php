<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGFilter;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGFilterType;

abstract class AVGFilter implements \JsonSerializable
{
    /**
     * @param AVGFilterType $type The type of the AVG filter
     */
    public function __construct(
        public AVGFilterType $type,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type->value,
        ];
    }
}
