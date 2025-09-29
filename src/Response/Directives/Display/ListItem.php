<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

class ListItem
{
    public ?string $token = null;

    public ?Image $image = null;

    public ?TextContent $textContent = null;

    public static function create(?string $token = null, ?Image $image = null, ?TextContent $textContent = null): self
    {
        $listItem = new self();

        $listItem->token = $token;
        $listItem->image = $image;
        $listItem->textContent = $textContent;

        return $listItem;
    }
}
