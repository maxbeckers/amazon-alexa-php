<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Environment;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutDirection;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $lang = 'en-US';
        $layoutDirection = LayoutDirection::RTL;
        $parameters = ['param1', 'param2', 'param3'];

        $environment = new Environment($lang, $layoutDirection, $parameters);

        $this->assertSame($lang, $environment->lang);
        $this->assertSame($layoutDirection, $environment->layoutDirection);
        $this->assertSame($parameters, $environment->parameters);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $environment = new Environment();

        $this->assertNull($environment->lang);
        $this->assertNull($environment->layoutDirection);
        $this->assertNull($environment->parameters);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $lang = 'fr-FR';
        $layoutDirection = LayoutDirection::LTR;
        $parameters = ['width', 'height', 'theme'];

        $environment = new Environment($lang, $layoutDirection, $parameters);
        $result = $environment->jsonSerialize();

        $this->assertSame($lang, $result['lang']);
        $this->assertSame($layoutDirection->value, $result['layoutDirection']);
        $this->assertSame($parameters, $result['parameters']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $environment = new Environment();
        $result = $environment->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('lang', $result);
        $this->assertArrayNotHasKey('layoutDirection', $result);
        $this->assertArrayNotHasKey('parameters', $result);
    }

    public function testJsonSerializeWithEmptyParameters(): void
    {
        $environment = new Environment('en-GB', LayoutDirection::LTR, []);
        $result = $environment->jsonSerialize();

        $this->assertSame('en-GB', $result['lang']);
        $this->assertSame(LayoutDirection::LTR->value, $result['layoutDirection']);
        $this->assertArrayNotHasKey('parameters', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $environment = new Environment('de-DE', null, ['locale']);
        $result = $environment->jsonSerialize();

        $this->assertSame('de-DE', $result['lang']);
        $this->assertSame(['locale'], $result['parameters']);
        $this->assertArrayNotHasKey('layoutDirection', $result);
    }

    public function testJsonSerializeWithDifferentLayoutDirections(): void
    {
        $directions = [LayoutDirection::LTR, LayoutDirection::RTL];

        foreach ($directions as $direction) {
            $environment = new Environment(layoutDirection: $direction);
            $result = $environment->jsonSerialize();

            $this->assertSame($direction->value, $result['layoutDirection']);
        }
    }

    public function testJsonSerializeWithSingleParameter(): void
    {
        $environment = new Environment(parameters: ['singleParam']);
        $result = $environment->jsonSerialize();

        $this->assertSame(['singleParam'], $result['parameters']);
    }

    public function testJsonSerializeWithMultipleParameters(): void
    {
        $parameters = ['param1', 'param2', 'param3', 'param4'];
        $environment = new Environment(parameters: $parameters);
        $result = $environment->jsonSerialize();

        $this->assertSame($parameters, $result['parameters']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $environment = new Environment();

        $this->assertInstanceOf(\JsonSerializable::class, $environment);
    }
}
