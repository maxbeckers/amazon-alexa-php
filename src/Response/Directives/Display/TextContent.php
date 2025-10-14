<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class TextContent implements \JsonSerializable
{
    use SerializeValueMapper;

    public function __construct(
        public ?Text $primaryText = null,
        public ?Text $secondaryText = null,
        public ?Text $tertiaryText = null
    ) {
    }

    public static function create(?Text $primaryText = null, ?Text $secondaryText = null, ?Text $tertiaryText = null): self
    {
        return new self($primaryText, $secondaryText, $tertiaryText);
    }

    public function jsonSerialize(): \ArrayObject
    {
        $data = new \ArrayObject();

        $this->valueToArrayIfSet($data, 'primaryText');
        $this->valueToArrayIfSet($data, 'secondaryText');
        $this->valueToArrayIfSet($data, 'tertiaryText');

        return $data;
    }
}
