<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Display\Image;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Metadata implements \JsonSerializable
{
    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $subtitle;

    /**
     * @var Image|null
     */
    public $art;

    /**
     * @var Image|null
     */
    public $backgroundImage;

    /**
     * @param string|null $title
     * @param string|null $subtitle
     * @param Image|null  $art
     * @param Image|null  $backgroundImage
     *
     * @return Metadata
     */
    public static function create(string $title = null, string $subtitle = null, Image $art = null, Image $backgroundImage = null): self
    {
        $metadata = new self();

        $metadata->title           = $title;
        $metadata->subtitle        = $subtitle;
        $metadata->art             = $art;
        $metadata->backgroundImage = $backgroundImage;

        return $metadata;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
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
