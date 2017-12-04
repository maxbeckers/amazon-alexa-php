<?php

use \PHPUnit\Framework\TestCase;
use MaxBeckers\AmazonAlexa\Request\Request\Display\ElementSelectedRequest;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class ElementSelectedRequestTest extends TestCase
{
    public function testFromAmazonRequest()
    {
        $req = ElementSelectedRequest::fromAmazonRequest(json_decode(file_get_contents(__DIR__.'/RequestData/displayElementSelected.json'), true));
        $this->assertInstanceOf(ElementSelectedRequest::class, $req);
        $this->assertEquals($req->type, 'Display.ElementSelected');
        $this->assertEquals($req->requestId, 'amzn1.echo-api.request.7zzzzzzzzz');
        $this->assertEquals($req->locale, 'en-US');
    }

}