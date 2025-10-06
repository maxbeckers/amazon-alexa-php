<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Display\Image;

class Metadata implements \JsonSerializable
{
    public function __construct(
        public ?string $title = null,
        public ?string $subtitle = null,
        public ?Image $art = null,
        public ?Image $backgroundImage = null
    ) {
    }

    /**
     * @param string|null $title
     * @param string|null $subtitle
     * @param Image|null $art
     * @param Image|null $backgroundImage
     *
     * @return Metadata
     */
    public static function create(?string $title = null, ?string $subtitle = null, ?Image $art = null, ?Image $backgroundImage = null): self
    {
        return new self($title, $subtitle, $art, $backgroundImage);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if (null !== $this->title) {
            $data['title'] = $this->title;
        }
        if (null !== $this->subtitle) {
            $data['subtitle'] = $this->subtitle;
        }
        if (null !== $this->art) {
            $data['art'] = $this->art;
        }
        if (null !== $this->backgroundImage) {
            $data['backgroundImage'] = $this->backgroundImage;
        }

        return $data;
    }
}
