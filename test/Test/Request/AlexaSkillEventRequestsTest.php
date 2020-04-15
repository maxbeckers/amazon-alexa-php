<?php

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillAccountLinkedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillDisabledBody;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillDisabledRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillEnabledRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillPermissionAcceptedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillPermissionChangedRequest;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class AlexaSkillEventRequestsTest extends TestCase
{
    public function testSkillAccountLinkedRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/alexaskilleventAccountLinked.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillAccountLinkedRequest::class, $request->request);
        $this->assertEquals('string', $request->request->body->accessToken);
    }

    public function testSkillEnabledRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/alexaskilleventEnabled.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillEnabledRequest::class, $request->request);
    }

    public function testSkillDisabledRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/alexaskilleventDisabled.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillDisabledRequest::class, $request->request);
        $this->assertEquals(SkillDisabledBody::PERSISTED, $request->request->body->userInformationPersistenceStatus);
    }

    public function testSkillPermissionAcceptedRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/alexaskilleventPermissionAccepted.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillPermissionAcceptedRequest::class, $request->request);
        $this->assertEquals('string', $request->request->body->acceptedPermissions[0]->scope);
    }

    public function testSkillPermissionChangedRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/alexaskilleventPermissionChanged.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillPermissionChangedRequest::class, $request->request);
        $this->assertEquals('string', $request->request->body->acceptedPermissions[0]->scope);
    }

    public function testPlaybackFinishedRequestWithNumericTimestamp()
    {
        $requestBody                                   = json_decode(file_get_contents(__DIR__.'/RequestData/alexaskilleventEnabled.json'), true);
        $requestBody['request']['timeStamp']           = 65545900;
        $requestBody['request']['eventCreationTime']   = 65545900;
        $requestBody['request']['eventPublishingTime'] = 65545900;
        $requestBody                                   = json_encode($requestBody);
        $request                                       = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SkillEnabledRequest::class, $request->request);
    }
}
