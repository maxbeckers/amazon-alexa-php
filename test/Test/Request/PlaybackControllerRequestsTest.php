<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\NextCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PauseCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PlayCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PreviousCommandIssued;
use PHPUnit\Framework\TestCase;

class PlaybackControllerRequestsTest extends TestCase
{
    public function testNextCommandIssued(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/playbackcontrollerNextCommandIssued.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(NextCommandIssued::class, $request->request);
    }

    public function testPauseCommandIssued(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/playbackcontrollerPauseCommandIssued.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PauseCommandIssued::class, $request->request);
    }

    public function testPlayCommandIssued(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/playbackcontrollerPlayCommandIssued.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PlayCommandIssued::class, $request->request);
    }

    public function testPreviousCommandIssued(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/playbackcontrollerPreviousCommandIssued.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PreviousCommandIssued::class, $request->request);
    }

    public function testPreviousCommandIssuedWithNumericTimestamp(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/playbackcontrollerPreviousCommandIssued.json');
        $requestBody = json_decode($requestBody, true);
        $requestBody['request']['timestamp'] = 65545900;
        $requestBody = json_encode($requestBody);
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PreviousCommandIssued::class, $request->request);
    }
}
