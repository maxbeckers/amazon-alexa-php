<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

class AudioItem implements \JsonSerializable
{
    public Stream $stream;
    public ?Metadata $metadata = null;

    public static function create(Stream $steam, ?Metadata $metadata = null): self
    {
        $audioItem = new self();

        $audioItem->stream = $steam;
        $audioItem->metadata = $metadata;

        return $audioItem;
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
