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
    public $version;

    /**
     * @var array
     */
    public $sessionAttributes;

    /**
     * @var ResponseBody
     */
    public $response;

    /**
     * Create a new response with an empty response body
     *
     * @param array  $sessionAttributes
     * @param string $version
     */
    public function __construct(array $sessionAttributes = [], string $version = '1.0')
    {
        $this->response          = new ResponseBody();
        $this->sessionAttributes = $sessionAttributes;
        $this->version           = $version;
    }
}
