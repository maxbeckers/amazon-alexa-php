<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Context
{
    public ?System $system = null;
    public ?AudioPlayer $audioPlayer = null;
    public ?Geolocation $geolocation = null;

    /**
     * @param array $amazonRequest
     *
     * @return Context
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $context = new self();

        $context->system = isset($amazonRequest['System']) ? System::fromAmazonRequest($amazonRequest['System']) : null;
        $context->audioPlayer = isset($amazonRequest['AudioPlayer']) ? AudioPlayer::fromAmazonRequest($amazonRequest['AudioPlayer']) : null;
        $context->geolocation = isset($amazonRequest['Geolocation']) ? Geolocation::fromAmazonRequest($amazonRequest['Geolocation']) : null;

        return $context;
    }
}
