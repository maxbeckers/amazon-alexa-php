<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ImageSource
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
}
