<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response;

use MaxBeckers\AmazonAlexa\Response\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testEmptyResponse(): void
    {
        $response = new Response();
        $this->assertSame('{"sessionAttributes":[],"version":"1.0","response":{}}', json_encode($response));
    }
}
