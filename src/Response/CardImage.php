<?php

namespace MaxBeckers\AmazonAlexa\Response;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class CardImage
{
    /**
     * @var string|null
     */
    public $smallImageUrl;

    /**
     * @var string|null
     */
    public $largeImageUrl;

    /**
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     *
     * @return CardImage
     */
    public static function fromUrls(string $smallImageUrl, string $largeImageUrl): self
    {
        $cardImage = new self();

        $cardImage->smallImageUrl = $smallImageUrl;
        $cardImage->largeImageUrl = $largeImageUrl;

        return $cardImage;
    }
}
