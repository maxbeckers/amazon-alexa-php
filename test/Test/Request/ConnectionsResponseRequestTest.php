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
        $this->assertEquals('apple_pie', $request->request->token);
        $this->assertEquals('200', $request->request->status->code);
        $this->assertEquals('Upsell', $request->request->name);
        $this->assertEquals('ACCEPTED', $request->request->payload->purchaseResult);
    }
}
