<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class PseudoLocalization implements \JsonSerializable
{
    public function __construct(
        public bool $enabled = false,
        public int $expansionPercentage = 30,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->enabled) {
            $data['enabled'] = $this->enabled;
        }
        if ($this->expansionPercentage !== 30) {
            $data['expansionPercentage'] = $this->expansionPercentage;
        }

        return $data;
    }
}
