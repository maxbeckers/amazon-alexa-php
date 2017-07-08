<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Stream
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string|null
     */
    public $expectedPreviousToken;

    /**
     * @var int|null
     */
    public $offsetInMilliseconds;
}
