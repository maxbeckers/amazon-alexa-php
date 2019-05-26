<?php

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use PHPUnit\Framework\TestCase;

/**
 * @author Charlie Root <charlie@chrl.ru>
 */
class ConnectionsResponseRequestTest extends TestCase
{
    public function testConnectionsResponseRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/connectionsResponseRequest.json');

        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(Request\System\ConnectionsResponseRequest::class, $request->request);
    }
}
