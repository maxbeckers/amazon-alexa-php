<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillAccountLinkedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillDisabledBody;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillDisabledRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillEnabledRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillPermissionAcceptedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillPermissionChangedRequest;
use PHPUnit\Framework\TestCase;

class AlexaSkillEventRequestsTest extends TestCase
{
    public function testSkillAccountLinkedRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/alexaskilleventAccountLinked.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillAccountLinkedRequest::class, $request->request);
        $this->assertEquals('string', $request->request->body->accessToken);
    }

    public function testSkillEnabledRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/alexaskilleventEnabled.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillEnabledRequest::class, $request->request);
    }

    public function testSkillDisabledRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/alexaskilleventDisabled.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillDisabledRequest::class, $request->request);
        $this->assertEquals(SkillDisabledBody::PERSISTED, $request->request->body->userInformationPersistenceStatus);
    }

    public function testSkillPermissionAcceptedRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/alexaskilleventPermissionAccepted.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillPermissionAcceptedRequest::class, $request->request);
        $this->assertEquals('string', $request->request->body->acceptedPermissions[0]->scope);
    }

    public function testSkillPermissionChangedRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/alexaskilleventPermissionChanged.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillPermissionChangedRequest::class, $request->request);
        $this->assertEquals('string', $request->request->body->acceptedPermissions[0]->scope);
    }

    public function testPlaybackFinishedRequestWithNumericTimestamp(): void
    {
        $requestBody = json_decode(file_get_contents(__DIR__ . '/RequestData/alexaskilleventEnabled.json'), true);
        $requestBody['request']['timeStamp'] = 65545900;
        $requestBody['request']['eventCreationTime'] = 65545900;
        $requestBody['request']['eventPublishingTime'] = 65545900;
        $requestBody = json_encode($requestBody);
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillEnabledRequest::class, $request->request);
    }
}
