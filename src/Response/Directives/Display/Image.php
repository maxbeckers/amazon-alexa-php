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
     * @param string|null $contentDescription
     * @param null|ImageSource|ImageSource[] $imageSource
     * @return Image
     */
    public static function create($contentDescription = null, $imageSource = null): Image
    {
        $image = new self();

        $image->contentDescription     = $contentDescription;

        if (!is_null($imageSource))
        {
            if (is_array($imageSource))
            {
                $image->sources = $imageSource;
            }
            else
            {
                $image->sources[] = $imageSource;
            }
        }
        return $image;
    }
}
