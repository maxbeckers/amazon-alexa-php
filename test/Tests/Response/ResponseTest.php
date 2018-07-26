<?php


use MaxBeckers\AmazonAlexa\Response\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testEmptyResponse()
    {
        $response = new Response();
        $this->assertSame('{"version":"1.0","sessionAttributes":[],"response":{}}', json_encode($response));
    }
}
