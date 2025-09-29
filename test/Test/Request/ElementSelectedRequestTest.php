<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request\Display\ElementSelectedRequest;
use PHPUnit\Framework\TestCase;

class ElementSelectedRequestTest extends TestCase
{
    public function testFromAmazonRequest(): void
    {
        $req = ElementSelectedRequest::fromAmazonRequest(json_decode(file_get_contents(__DIR__ . '/RequestData/displayElementSelected.json'), true));
        $this->assertInstanceOf(ElementSelectedRequest::class, $req);
        $this->assertSame($req->type, 'Display.ElementSelected');
        $this->assertSame($req->requestId, 'amzn1.echo-api.request.7zzzzzzzzz');
        $this->assertSame($req->locale, 'en-US');
    }
}
