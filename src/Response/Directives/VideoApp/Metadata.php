<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\VideoApp;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Metadata
{
    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $subtitle;

    /**
     * @param array $amazonRequest
     *
     * @return Metadata
     */
    public static function fromAmazonRequest(array $amazonRequest): Metadata
    {
        $metadata = new self();

        $metadata->title    = isset($amazonRequest['title']) ? $amazonRequest['title'] : null;
        $metadata->subtitle = isset($amazonRequest['subtitle']) ? $amazonRequest['subtitle'] : null;

        return $metadata;
    }

    /**
     * @param string|null $title
     * @param string|null $subtitle
     * @return Metadata
     */
    public static function create(string $title = null, string $subtitle = null): Metadata
    {
        $metadata = new self();

        $metadata->title    = $title;
        $metadata->subtitle = $subtitle;

        return $metadata;
    }
}
