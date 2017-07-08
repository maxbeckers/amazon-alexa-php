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
}
