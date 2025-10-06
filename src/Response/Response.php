<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

class Response
{
    /**
     * Create a new response with an empty response body.
     */
    public function __construct(
        public array $sessionAttributes = [],
        public string $version = '1.0',
        public ResponseBodyInterface $response = new ResponseBody()
    ) {
    }
}
