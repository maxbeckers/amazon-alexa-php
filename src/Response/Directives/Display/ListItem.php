<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ListItem
{
    /**
     * @var string|null
     */
    public $token;

    /**
     * @var Image|null
     */
    public $image;

    /**
     * @var TextContent|null
     */
    public $textContent;
}
