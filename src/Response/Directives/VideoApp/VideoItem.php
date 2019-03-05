<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\VideoApp;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class VideoItem
{
    /**
     * @var string|null
     */
    public $source;

    /**
     * @var Metadata|null
     */
    public $metadata;

    /**
     * @param string        $source
     * @param Metadata|null $metadata
     *
     * @return VideoItem
     */
    public static function create(string $source, Metadata $metadata = null): self
    {
        $videoItem = new self();

        $videoItem->source   = $source;
        $videoItem->metadata = $metadata;

        return $videoItem;
    }
}
