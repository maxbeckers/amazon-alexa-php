<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
abstract class AbstractPlaybackDirective extends Directive
{
    /**
     * @var string
     */
    public $requestId;

    /**
     * @var string
     */
    public $timestamp;

    /**
     * @var string
     */
    public $token;

    /**
     * @var int
     */
    public $offsetInMilliseconds;

    /**
     * @var string
     */
    public $locale;

    /**
     * @param string $requestId
     * @param string $timestamp
     * @param string $token
     * @param int    $offsetInMilliseconds
     * @param string $locale
     */
    public function setProperties(string $requestId, string $timestamp, string $token, int $offsetInMilliseconds, string $locale)
    {
        $this->requestId            = $requestId;
        $this->timestamp            = $timestamp;
        $this->token                = $token;
        $this->offsetInMilliseconds = $offsetInMilliseconds;
        $this->locale               = $locale;
    }
}
