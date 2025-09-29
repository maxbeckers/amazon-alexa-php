<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;

class ImageSource implements \JsonSerializable
{
    use SerializeValueMapper;

    public const SIZE_X_SMALL = 'X_SMALL';
    public const SIZE_SMALL = 'SMALL';
    public const SIZE_MEDIUM = 'MEDIUM';
    public const SIZE_LARGE = 'LARGE';
    public const SIZE_X_LARGE = 'X_LARGE';

    public ?string $url = null;
    public ?string $size = null;
    public ?int $widthPixels = null;
    public ?int $heightPixels = null;

    public static function create(string $url, ?string $size = null, ?int $widthPixels = null, ?int $heightPixels = null): self
    {
        $imageSource = new self();

        $imageSource->url = $url;
        $imageSource->size = $size;
        $imageSource->widthPixels = $widthPixels;
        $imageSource->heightPixels = $heightPixels;

        return $imageSource;
    }

    public function jsonSerialize(): \ArrayObject
    {
        $data = new \ArrayObject();

        $this->valueToArrayIfSet($data, 'url');
        $this->valueToArrayIfSet($data, 'size');
        $this->valueToArrayIfSet($data, 'widthPixels');
        $this->valueToArrayIfSet($data, 'heightPixels');

        return $data;
    }
}
