<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ImageSource implements \JsonSerializable
{
    const SIZE_X_SMALL = 'X_SMALL';
    const SIZE_SMALL   = 'SMALL';
    const SIZE_MEDIUM  = 'MEDIUM';
    const SIZE_LARGE   = 'LARGE';
    const SIZE_X_LARGE = 'X_LARGE';

    /**
     * @var string|null
     */
    public $url;

    /**
     * @var string|null
     */
    public $size;

    /**
     * @var int|null
     */
    public $widthPixels;

    /**
     * @var int|null
     */
    public $heightPixels;

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = [];

        if (null !== $this->url) $data['url'] = $this->url;
        if (null !== $this->size) $data['size'] = $this->size;
        if (null !== $this->widthPixels) $data['widthPixels'] = $this->widthPixels;
        if (null !== $this->heightPixels) $data['heightPixels'] = $this->heightPixels;

        return $data;
    }

    /**
     * @param string      $url
     * @param string|null $size
     * @param int|null    $widthPixels
     * @param int|null    $heightPixels
     *
     * @return ImageSource
     */
    public static function create($url, $size = null, $widthPixels = null, $heightPixels = null): ImageSource
    {
        $imageSource = new self();

        $imageSource->url          = $url;
        $imageSource->size         = $size;
        $imageSource->widthPixels  = $widthPixels;
        $imageSource->heightPixels = $heightPixels;

        return $imageSource;
    }
}
