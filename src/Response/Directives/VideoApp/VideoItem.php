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
     * @param array $amazonRequest
     *
     * @return VideoItem
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $request = new self();

        $request->source   = isset($amazonRequest['source']) ? $amazonRequest['source'] : null;
        $request->metadata = isset($amazonRequest['metadata']) ? Metadata::fromAmazonRequest($amazonRequest['metadata']) : null;

        return $request;
    }

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
