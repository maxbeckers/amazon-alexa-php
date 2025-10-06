<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

class Image
{
    /** @var ImageSource[] */
    public function __construct(
        public ?string $contentDescription = null,
        public array $sources = []
    ) {
    }

    public static function create(?string $contentDescription = null, array $imageSources = []): self
    {
        return new self($contentDescription, $imageSources);
    }

    public function addImageSource(ImageSource $imageSource): void
    {
        $this->sources[] = $imageSource;
    }
}
