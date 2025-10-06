<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\PseudoLocalization;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Settings;
use PHPUnit\Framework\TestCase;

class SettingsTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $idleTimeout = 5000;
        $pseudoLocalization = $this->createMock(PseudoLocalization::class);
        $supportsResizing = true;

        $settings = new Settings($idleTimeout, $pseudoLocalization, $supportsResizing);

        $this->assertSame($idleTimeout, $settings->idleTimeout);
        $this->assertSame($pseudoLocalization, $settings->pseudoLocalization);
        $this->assertTrue($settings->supportsResizing);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $settings = new Settings();

        $this->assertNull($settings->idleTimeout);
        $this->assertNull($settings->pseudoLocalization);
        $this->assertFalse($settings->supportsResizing);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $idleTimeout = 3000;
        $pseudoLocalization = $this->createMock(PseudoLocalization::class);

        $settings = new Settings($idleTimeout, $pseudoLocalization, true);
        $result = $settings->jsonSerialize();

        $this->assertSame($idleTimeout, $result['idleTimeout']);
        $this->assertSame($pseudoLocalization, $result['pseudoLocalization']);
        $this->assertTrue($result['supportsResizing']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $settings = new Settings();
        $result = $settings->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('idleTimeout', $result);
        $this->assertArrayNotHasKey('pseudoLocalization', $result);
        $this->assertArrayNotHasKey('supportsResizing', $result);
    }

    public function testJsonSerializeWithIntegerIdleTimeout(): void
    {
        $settings = new Settings(10000);
        $result = $settings->jsonSerialize();

        $this->assertArrayHasKey('idleTimeout', $result);
        $this->assertSame(10000, $result['idleTimeout']);
        $this->assertIsInt($result['idleTimeout']);
    }

    public function testJsonSerializeWithFloatIdleTimeout(): void
    {
        $settings = new Settings(2500.5);
        $result = $settings->jsonSerialize();

        $this->assertArrayHasKey('idleTimeout', $result);
        $this->assertSame(2500.5, $result['idleTimeout']);
        $this->assertIsFloat($result['idleTimeout']);
    }

    public function testJsonSerializeWithPseudoLocalizationOnly(): void
    {
        $pseudoLocalization = $this->createMock(PseudoLocalization::class);
        $settings = new Settings(null, $pseudoLocalization);
        $result = $settings->jsonSerialize();

        $this->assertArrayHasKey('pseudoLocalization', $result);
        $this->assertSame($pseudoLocalization, $result['pseudoLocalization']);
        $this->assertArrayNotHasKey('idleTimeout', $result);
        $this->assertArrayNotHasKey('supportsResizing', $result);
    }

    public function testJsonSerializeWithSupportsResizingTrue(): void
    {
        $settings = new Settings(null, null, true);
        $result = $settings->jsonSerialize();

        $this->assertArrayHasKey('supportsResizing', $result);
        $this->assertTrue($result['supportsResizing']);
        $this->assertArrayNotHasKey('idleTimeout', $result);
        $this->assertArrayNotHasKey('pseudoLocalization', $result);
    }

    public function testJsonSerializeWithSupportsResizingFalse(): void
    {
        $settings = new Settings(null, null, false);
        $result = $settings->jsonSerialize();

        $this->assertArrayNotHasKey('supportsResizing', $result);
    }

    public function testJsonSerializeWithZeroIdleTimeout(): void
    {
        $settings = new Settings(0);
        $result = $settings->jsonSerialize();

        $this->assertArrayHasKey('idleTimeout', $result);
        $this->assertSame(0, $result['idleTimeout']);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $settings = new Settings(1500, null, true);
        $result = $settings->jsonSerialize();

        $this->assertArrayHasKey('idleTimeout', $result);
        $this->assertArrayHasKey('supportsResizing', $result);
        $this->assertArrayNotHasKey('pseudoLocalization', $result);
        $this->assertSame(1500, $result['idleTimeout']);
        $this->assertTrue($result['supportsResizing']);
    }

    public function testJsonSerializePropertyOrder(): void
    {
        $pseudoLocalization = $this->createMock(PseudoLocalization::class);
        $settings = new Settings(2000, $pseudoLocalization, true);
        $result = $settings->jsonSerialize();

        $keys = array_keys($result);
        $this->assertSame('idleTimeout', $keys[0]);
        $this->assertSame('pseudoLocalization', $keys[1]);
        $this->assertSame('supportsResizing', $keys[2]);
    }

    public function testImplementsJsonSerializable(): void
    {
        $settings = new Settings();

        $this->assertInstanceOf(\JsonSerializable::class, $settings);
    }
}
