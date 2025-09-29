<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

class CardImage
{
    public ?string $smallImageUrl = null;
    public ?string $largeImageUrl = null;

    public static function fromUrls(string $smallImageUrl, string $largeImageUrl): self
    {
        $cardImage = new self();

        $cardImage->smallImageUrl = $smallImageUrl;
        $cardImage->largeImageUrl = $largeImageUrl;

        return $cardImage;
    }
}
