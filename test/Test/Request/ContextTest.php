<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Advertising;
use MaxBeckers\AmazonAlexa\Request\AlexaPresentationAPL;
use MaxBeckers\AmazonAlexa\Request\ComponentVisibleOnScreen;
use MaxBeckers\AmazonAlexa\Request\Context;
use MaxBeckers\AmazonAlexa\Request\Entity;
use MaxBeckers\AmazonAlexa\Request\Experience;
use MaxBeckers\AmazonAlexa\Request\KeyboardType;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\LaunchRequest;
use MaxBeckers\AmazonAlexa\Request\TouchType;
use MaxBeckers\AmazonAlexa\Request\Video;
use MaxBeckers\AmazonAlexa\Request\Viewport;
use MaxBeckers\AmazonAlexa\Request\ViewportMode;
use MaxBeckers\AmazonAlexa\Request\ViewportShape;
use MaxBeckers\AmazonAlexa\Request\ViewportTag;
use PHPUnit\Framework\TestCase;

class ContextTest extends TestCase
{
    public function testContextWithAPLAndAdvancedFields(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/contextWithAPL.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');

        $this->assertInstanceOf(LaunchRequest::class, $request->request);
        $this->assertInstanceOf(Context::class, $request->context);

        // Test Advertising
        $this->assertInstanceOf(Advertising::class, $request->context->advertising);
        $this->assertEquals('12345-advertising-id', $request->context->advertising->advertisingId);
        $this->assertFalse($request->context->advertising->limitAdTracking);

        // Test Viewport
        $this->assertInstanceOf(Viewport::class, $request->context->viewport);
        $this->assertEquals(ViewportMode::TV, $request->context->viewport->mode);
        $this->assertEquals(ViewportShape::RECTANGLE, $request->context->viewport->shape);
        $this->assertEquals(1920, $request->context->viewport->pixelWidth);
        $this->assertEquals(1080, $request->context->viewport->pixelHeight);
        $this->assertEquals(160, $request->context->viewport->dpi);

        // Test Viewport Experiences
        $this->assertCount(1, $request->context->viewport->experiences);
        $this->assertInstanceOf(Experience::class, $request->context->viewport->experiences[0]);
        $this->assertEquals('246', $request->context->viewport->experiences[0]->arcMinuteWidth);
        $this->assertEquals('144', $request->context->viewport->experiences[0]->arcMinuteHeight);
        $this->assertFalse($request->context->viewport->experiences[0]->canRotate);

        // Test Viewport Touch and Keyboard
        $this->assertCount(1, $request->context->viewport->touch);
        $this->assertEquals(TouchType::SINGLE, $request->context->viewport->touch[0]);
        $this->assertCount(1, $request->context->viewport->keyboard);
        $this->assertEquals(KeyboardType::DIRECTION, $request->context->viewport->keyboard[0]);

        // Test Viewport Video
        $this->assertInstanceOf(Video::class, $request->context->viewport->video);
        $this->assertCount(2, $request->context->viewport->video->codecs);
        $this->assertEquals('H_264_42', $request->context->viewport->video->codecs[0]);
        $this->assertEquals('H_264_41', $request->context->viewport->video->codecs[1]);

        // Test Viewports array
        $this->assertCount(1, $request->context->viewports);
        $this->assertInstanceOf(Viewport::class, $request->context->viewports[0]);
        $this->assertEquals(ViewportMode::HUB, $request->context->viewports[0]->mode);
        $this->assertEquals(ViewportShape::ROUND, $request->context->viewports[0]->shape);
        $this->assertEquals(960, $request->context->viewports[0]->pixelWidth);

        // Test Alexa.Presentation.APL
        $this->assertInstanceOf(AlexaPresentationAPL::class, $request->context->apl);
        $this->assertEquals('apl-token-123', $request->context->apl->token);
        $this->assertEquals('2024.1', $request->context->apl->version);
        $this->assertCount(1, $request->context->apl->componentsVisibleOnScreen);

        // Test ComponentVisibleOnScreen
        $component = $request->context->apl->componentsVisibleOnScreen[0];
        $this->assertInstanceOf(ComponentVisibleOnScreen::class, $component);
        $this->assertEquals('main-container', $component->id);
        $this->assertEquals('Container', $component->type);
        $this->assertEquals(':10001', $component->uid);
        $this->assertEquals('1280x720+0+0:0', $component->position);

        // Test Component Entities
        $this->assertCount(1, $component->entities);
        $this->assertInstanceOf(Entity::class, $component->entities[0]);
        $this->assertEquals('entity1', $component->entities[0]->id);
        $this->assertEquals('text', $component->entities[0]->type);
        $this->assertEquals('Hello World', $component->entities[0]->value);

        // Test Component Tags with Viewport
        $this->assertNotNull($component->tags);
        $this->assertInstanceOf(ViewportTag::class, $component->tags->viewport);
        $this->assertEquals('2024-01-01T12:00:00Z', $component->tags->viewport->utcTime);
        $this->assertEquals(5000, $component->tags->viewport->elapsedTime);

        // Test Extensions
        $this->assertNotNull($request->context->extensions);
        $this->assertArrayHasKey('available', $request->context->extensions);
        $this->assertArrayHasKey('settings', $request->context->extensions);
        $this->assertArrayHasKey('aplext:backstack:10', $request->context->extensions['available']);
    }

    public function testAdvertisingFromAmazonRequest(): void
    {
        $amazonRequest = [
            'advertisingId' => 'test-ad-id',
            'limitAdTracking' => true,
        ];

        $advertising = Advertising::fromAmazonRequest($amazonRequest);

        $this->assertInstanceOf(Advertising::class, $advertising);
        $this->assertEquals('test-ad-id', $advertising->advertisingId);
        $this->assertTrue($advertising->limitAdTracking);
    }

    public function testViewportFromAmazonRequest(): void
    {
        $amazonRequest = [
            'mode' => 'HUB',
            'shape' => 'ROUND',
            'pixelWidth' => 1024,
            'pixelHeight' => 600,
            'dpi' => 160,
            'touch' => ['SINGLE'],
            'keyboard' => ['DIRECTION'],
            'video' => [
                'codecs' => ['H_264_42'],
            ],
            'experiences' => [
                [
                    'arcMinuteWidth' => '120',
                    'arcMinuteHeight' => '80',
                    'canRotate' => true,
                    'canResize' => false,
                ],
            ],
        ];

        $viewport = Viewport::fromAmazonRequest($amazonRequest);

        $this->assertInstanceOf(Viewport::class, $viewport);
        $this->assertEquals(ViewportMode::HUB, $viewport->mode);
        $this->assertEquals(ViewportShape::ROUND, $viewport->shape);
        $this->assertEquals(1024, $viewport->pixelWidth);
        $this->assertEquals(600, $viewport->pixelHeight);
        $this->assertEquals(160, $viewport->dpi);
        $this->assertCount(1, $viewport->touch);
        $this->assertEquals(TouchType::SINGLE, $viewport->touch[0]);
        $this->assertCount(1, $viewport->keyboard);
        $this->assertEquals(KeyboardType::DIRECTION, $viewport->keyboard[0]);
        $this->assertInstanceOf(Video::class, $viewport->video);
        $this->assertCount(1, $viewport->video->codecs);
        $this->assertEquals('H_264_42', $viewport->video->codecs[0]);
        $this->assertCount(1, $viewport->experiences);
        $this->assertInstanceOf(Experience::class, $viewport->experiences[0]);
        $this->assertEquals('120', $viewport->experiences[0]->arcMinuteWidth);
        $this->assertTrue($viewport->experiences[0]->canRotate);
    }

    public function testAlexaPresentationAPLFromAmazonRequest(): void
    {
        $amazonRequest = [
            'token' => 'test-token',
            'version' => '2024.1',
            'componentsVisibleOnScreen' => [
                [
                    'id' => 'test-component',
                    'type' => 'Text',
                    'uid' => ':10001',
                    'position' => '100x100+0+0:0',
                    'entities' => [
                        [
                            'id' => 'test-entity',
                            'type' => 'text',
                            'value' => 'Test Value',
                        ],
                    ],
                ],
            ],
        ];

        $apl = AlexaPresentationAPL::fromAmazonRequest($amazonRequest);

        $this->assertInstanceOf(AlexaPresentationAPL::class, $apl);
        $this->assertEquals('test-token', $apl->token);
        $this->assertEquals('2024.1', $apl->version);
        $this->assertCount(1, $apl->componentsVisibleOnScreen);

        $component = $apl->componentsVisibleOnScreen[0];
        $this->assertInstanceOf(ComponentVisibleOnScreen::class, $component);
        $this->assertEquals('test-component', $component->id);
        $this->assertEquals('Text', $component->type);
        $this->assertEquals(':10001', $component->uid);
        $this->assertEquals('100x100+0+0:0', $component->position);
        $this->assertCount(1, $component->entities);

        $entity = $component->entities[0];
        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertEquals('test-entity', $entity->id);
        $this->assertEquals('text', $entity->type);
        $this->assertEquals('Test Value', $entity->value);
    }
}
