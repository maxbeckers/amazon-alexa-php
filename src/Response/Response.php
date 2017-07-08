<?php

namespace MaxBeckers\AmazonAlexa\Response;

/**
 * Response object.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Response
{
    /**
     * @var string
     */
    public $version = '1.0';

    /**
     * @var array
     */
    public $sessionAttributes = [];

    /**
     * @var ResponseBody
     */
    public $response;
}
