<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Stream implements \JsonSerializable
{
    use SerializeValueMapper;

    public function __construct(
        public string $url = '',
        public string $token = '',
        public ?string $expectedPreviousToken = null,
        public ?int $offsetInMilliseconds = null
    ) {
    }

    public static function create(string $url, string $token, ?string $expectedPreviousToken = null, ?int $offsetInMilliseconds = null): self
    {
        return new self($url, $token, $expectedPreviousToken, $offsetInMilliseconds);
    }

    public function jsonSerialize(): \ArrayObject
    {
        $data = new \ArrayObject([
            'url' => $this->url,
            'token' => $this->token,
        ]);

        $this->valueToArrayIfSet($data, 'expectedPreviousToken');
        $this->valueToArrayIfSet($data, 'offsetInMilliseconds');

        return $data;
    }
}
