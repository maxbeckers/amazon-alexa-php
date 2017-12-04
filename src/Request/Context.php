<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Context
{
    /**
     * @var System|null
     */
    public $system;

    /**
     * @var AudioPlayer|null
     */
    public $audioPlayer;

    /**
     * @param array $amazonRequest
     *
     * @return Context
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $context = new self();

        $context->system      = isset($amazonRequest['System']) ? System::fromAmazonRequest($amazonRequest['System']) : null;
        $context->audioPlayer = isset($amazonRequest['AudioPlayer']) ? AudioPlayer::fromAmazonRequest($amazonRequest['AudioPlayer']) : null;

        return $context;
    }
}
