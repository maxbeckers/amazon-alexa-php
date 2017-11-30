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

    /**
     * @param string|null      $token
     * @param Image|null       $image
     * @param TextContent|null $textContent
     *
     * @return ListItem
     */
    public static function create($token = null, $image = null, $textContent = null): ListItem
    {
        $listItem = new self();

        $listItem->token       = $token;
        $listItem->image       = $image;
        $listItem->textContent = $textContent;

        return $listItem;
    }
}
