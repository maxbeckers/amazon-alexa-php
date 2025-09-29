<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackFailedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackFinishedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackNearlyFinishedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackStartedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackStoppedRequest;
use PHPUnit\Framework\TestCase;

class AudioPlayerRequestsTest extends TestCase
{
    public function testPlaybackStartedRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/audioplayerPlaybackStarted.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PlaybackStartedRequest::class, $request->request);
    }

    public function testPlaybackFinishedRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/audioplayerPlaybackFinished.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PlaybackFinishedRequest::class, $request->request);
    }

    public function testPlaybackStoppedRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/audioplayerPlaybackStopped.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PlaybackStoppedRequest::class, $request->request);
    }

    public function testPlaybackNearlyFinishedRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/audioplayerPlaybackNearlyFinished.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PlaybackNearlyFinishedRequest::class, $request->request);
    }

    public function testPlaybackPlaybackFailedRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/audioplayerPlaybackFailed.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PlaybackFailedRequest::class, $request->request);
    }

    public function testPlaybackFinishedRequestWithNumericTimestamp(): void
    {
        $requestBody = json_decode(file_get_contents(__DIR__ . '/RequestData/audioplayerPlaybackFailed.json'), true);
        $requestBody['request']['timestamp'] = 65545900;
        $requestBody = json_encode($requestBody);
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(PlaybackFailedRequest::class, $request->request);
    }
}
