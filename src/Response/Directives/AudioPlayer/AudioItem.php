<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class AudioItem implements \JsonSerializable
{
    /**
     * @var Stream
     */
    public $stream;

    /**
     * @var Metadata
     */
    public $metadata;

    /**
     * @param Stream        $steam
     * @param Metadata|null $metadata
     *
     * @return AudioItem
     */
    public static function create(Stream $steam, Metadata $metadata = null): self
    {
        $audioItem = new self();

        $audioItem->stream   = $steam;
        $audioItem->metadata = $metadata;

        return $audioItem;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
