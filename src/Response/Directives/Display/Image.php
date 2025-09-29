<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

class Image
{
    public ?string $contentDescription = null;

    /** @var ImageSource[] */
    public array $sources = [];

    public static function create(?string $contentDescription = null, array $imageSources = []): self
    {
        $image = new self();

        $image->contentDescription = $contentDescription;
        $image->sources = $imageSources;

        return $image;
    }

    public function addImageSource(ImageSource $imageSource): void
    {
        $this->sources[] = $imageSource;
    }
}
