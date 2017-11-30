<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Image
{
    /**
     * @var string|null
     */
    public $contentDescription;

    /**
     * @var ImageSource[]
     */
    public $sources = [];

    /**
     * @param ImageSource $imageSource
     */
    public function addImageSource(ImageSource $imageSource)
    {
        $this->sources[] = $imageSource;
    }

    /**
     * @param string|null   $contentDescription
     * @param ImageSource[] $imageSources
     *
     * @return Image
     */
    public static function create($contentDescription = null, $imageSources = []): Image
    {
        $image = new self();

        $image->contentDescription = $contentDescription;

        $image->sources = $imageSources;

        return $image;
    }
}
