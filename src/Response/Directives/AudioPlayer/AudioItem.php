<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

class AudioItem implements \JsonSerializable
{
    public function __construct(
        public ?Stream $stream = null,
        public ?Metadata $metadata = null
    ) {
    }

    public static function create(Stream $steam, ?Metadata $metadata = null): self
    {
        return new self($steam, $metadata);
    }

    public function jsonSerialize(): array
    {
        $data = [
            'stream' => $this->stream,
        ];

        if (null !== $this->metadata) {
            $data['metadata'] = $this->metadata;
        }

        return $data;
    }
}
