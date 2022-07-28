<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ImageSource implements \JsonSerializable
{
    use SerializeValueMapper;

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
     * @param string      $url
     * @param string|null $size
     * @param int|null    $widthPixels
     * @param int|null    $heightPixels
     *
     * @return ImageSource
     */
    public static function create($url, $size = null, $widthPixels = null, $heightPixels = null): self
    {
        $imageSource = new self();

        $imageSource->url          = $url;
        $imageSource->size         = $size;
        $imageSource->widthPixels  = $widthPixels;
        $imageSource->heightPixels = $heightPixels;

        return $imageSource;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = new \ArrayObject();

        $this->valueToArrayIfSet($data, 'url');
        $this->valueToArrayIfSet($data, 'size');
        $this->valueToArrayIfSet($data, 'widthPixels');
        $this->valueToArrayIfSet($data, 'heightPixels');

        return $data;
    }
}
