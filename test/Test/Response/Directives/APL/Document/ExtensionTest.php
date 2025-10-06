<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Extension;
use PHPUnit\Framework\TestCase;

class ExtensionTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $name = 'testExtension';
        $uri = 'https://example.com/extension';
        $required = true;

        $extension = new Extension($name, $uri, $required);

        $this->assertSame($name, $extension->name);
        $this->assertSame($uri, $extension->uri);
        $this->assertTrue($extension->required);
    }

    public function testConstructorWithDefaultRequired(): void
    {
        $name = 'myExtension';
        $uri = 'https://test.com/ext';

        $extension = new Extension($name, $uri);

        $this->assertSame($name, $extension->name);
        $this->assertSame($uri, $extension->uri);
        $this->assertFalse($extension->required);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $name = 'extensionName';
        $uri = 'https://domain.com/extension.json';
        $required = true;

        $extension = new Extension($name, $uri, $required);
        $result = $extension->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertSame($uri, $result['uri']);
        $this->assertTrue($result['required']);
    }

    public function testJsonSerializeWithDefaultRequired(): void
    {
        $name = 'defaultExt';
        $uri = 'https://example.org/ext';

        $extension = new Extension($name, $uri);
        $result = $extension->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertSame($uri, $result['uri']);
        $this->assertFalse($result['required']);
    }

    public function testJsonSerializeWithRequiredFalse(): void
    {
        $extension = new Extension('test', 'uri', false);
        $result = $extension->jsonSerialize();

        $this->assertFalse($result['required']);
    }

    public function testJsonSerializeStructure(): void
    {
        $extension = new Extension('name', 'uri', true);
        $result = $extension->jsonSerialize();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('uri', $result);
        $this->assertArrayHasKey('required', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $extension = new Extension('test', 'uri');

        $this->assertInstanceOf(\JsonSerializable::class, $extension);
    }
}
