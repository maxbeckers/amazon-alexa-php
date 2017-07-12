<?php

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackFailedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackFinishedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackNearlyFinishedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackStartedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackStoppedRequest;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class AudioPlayerRequestsTest extends TestCase
{
    public function testPlaybackStartedRequest()
    {
        $requestHeaders = [
            'Signature'             => '',
            'SignatureCertChainUrl' => 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
        ];
        $requestBody    = file_get_contents(__DIR__.'/RequestData/audioplayerPlaybackStarted.json');
        $request        = Request::fromAmazonRequest($requestHeaders, $requestBody);
        $this->assertInstanceOf(PlaybackStartedRequest::class, $request->request);
    }

    public function testPlaybackFinishedRequest()
    {
        $requestHeaders = [
            'Signature'             => '',
            'SignatureCertChainUrl' => 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
        ];
        $requestBody    = file_get_contents(__DIR__.'/RequestData/audioplayerPlaybackFinished.json');
        $request        = Request::fromAmazonRequest($requestHeaders, $requestBody);
        $this->assertInstanceOf(PlaybackFinishedRequest::class, $request->request);
    }

    public function testPlaybackStoppedRequest()
    {
        $requestHeaders = [
            'Signature'             => '',
            'SignatureCertChainUrl' => 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
        ];
        $requestBody    = file_get_contents(__DIR__.'/RequestData/audioplayerPlaybackStopped.json');
        $request        = Request::fromAmazonRequest($requestHeaders, $requestBody);
        $this->assertInstanceOf(PlaybackStoppedRequest::class, $request->request);
    }

    public function testPlaybackNearlyFinishedRequest()
    {
        $requestHeaders = [
            'Signature'             => '',
            'SignatureCertChainUrl' => 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
        ];
        $requestBody    = file_get_contents(__DIR__.'/RequestData/audioplayerPlaybackNearlyFinished.json');
        $request        = Request::fromAmazonRequest($requestHeaders, $requestBody);
        $this->assertInstanceOf(PlaybackNearlyFinishedRequest::class, $request->request);
    }

    public function testPlaybackPlaybackFailedRequest()
    {
        $requestHeaders = [
            'Signature'             => '',
            'SignatureCertChainUrl' => 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
        ];
        $requestBody    = file_get_contents(__DIR__.'/RequestData/audioplayerPlaybackFailed.json');
        $request        = Request::fromAmazonRequest($requestHeaders, $requestBody);
        $this->assertInstanceOf(PlaybackFailedRequest::class, $request->request);
    }
}
