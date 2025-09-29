<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

class Response
{
    /**
     * Create a new response with an empty response body.
     *
     * @param array $sessionAttributes
     * @param string $version
     * @param ResponseBodyInterface|null $response
     */
    public function __construct(
        public array $sessionAttributes = [],
        public string $version = '1.0',
        public ResponseBodyInterface $response = new ResponseBody()
    ) {
    }
}
