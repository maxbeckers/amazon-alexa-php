<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

abstract class AbstractStandardCommand implements \JsonSerializable
{
    /**
     * @param string $type The type of the command
     */
    public function __construct(
        public string $type,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
