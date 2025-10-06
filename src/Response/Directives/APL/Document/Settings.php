<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

class Settings implements \JsonSerializable
{
    public function __construct(
        public int|float|null $idleTimeout = null,
        public ?PseudoLocalization $pseudoLocalization = null,
        public bool $supportsResizing = false,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->idleTimeout !== null) {
            $data['idleTimeout'] = $this->idleTimeout;
        }
        if ($this->pseudoLocalization !== null) {
            $data['pseudoLocalization'] = $this->pseudoLocalization;
        }
        if ($this->supportsResizing) {
            $data['supportsResizing'] = $this->supportsResizing;
        }

        return $data;
    }
}
