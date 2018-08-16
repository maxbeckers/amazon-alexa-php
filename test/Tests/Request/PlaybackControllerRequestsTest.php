<?php

namespace MaxBeckers\AmazonAlexa\Tests;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\NextCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PauseCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PlayCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PreviousCommandIssued;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlaybackControllerRequestsTest extends TestCase
{
    public function testNextCommandIssued()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/playbackcontrollerNextCommandIssued.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(NextCommandIssued::class, $request->request);
    }

    public function testPauseCommandIssued()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/playbackcontrollerPauseCommandIssued.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PauseCommandIssued::class, $request->request);
    }

    public function testPlayCommandIssued()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/playbackcontrollerPlayCommandIssued.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PlayCommandIssued::class, $request->request);
    }

    public function testPreviousCommandIssued()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/playbackcontrollerPreviousCommandIssued.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PreviousCommandIssued::class, $request->request);
    }

    public function testPreviousCommandIssuedWithNumericTimestamp()
    {
        $requestBody                         = file_get_contents(__DIR__.'/RequestData/playbackcontrollerPreviousCommandIssued.json');
        $requestBody                         = json_decode($requestBody, true);
        $requestBody['request']['timestamp'] = 65545900;
        $requestBody                         = json_encode($requestBody);
        $request                             = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PreviousCommandIssued::class, $request->request);
    }
}
