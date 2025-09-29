<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\VideoApp;

class VideoItem
{
    public ?string $source = null;
    public ?Metadata $metadata = null;

    public static function create(string $source, ?Metadata $metadata = null): self
    {
        $videoItem = new self();

        $videoItem->source = $source;
        $videoItem->metadata = $metadata;

        return $videoItem;
    }
}
