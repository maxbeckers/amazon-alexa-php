<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;

class TextContent implements \JsonSerializable
{
    use SerializeValueMapper;

    public ?Text $primaryText = null;
    public ?Text $secondaryText = null;
    public ?Text $tertiaryText = null;

    public static function create(?Text $primaryText = null, ?Text $secondaryText = null, ?Text $tertiaryText = null): self
    {
        $textContent = new self();

        $textContent->primaryText = $primaryText;
        $textContent->secondaryText = $secondaryText;
        $textContent->tertiaryText = $tertiaryText;

        return $textContent;
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
