<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\PseudoLocalization;
use PHPUnit\Framework\TestCase;

class PseudoLocalizationTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $enabled = true;
        $expansionPercentage = 50;

        $pseudoLocalization = new PseudoLocalization($enabled, $expansionPercentage);

        $this->assertTrue($pseudoLocalization->enabled);
        $this->assertSame($expansionPercentage, $pseudoLocalization->expansionPercentage);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $pseudoLocalization = new PseudoLocalization();

        $this->assertFalse($pseudoLocalization->enabled);
        $this->assertSame(30, $pseudoLocalization->expansionPercentage);
    }

    public function testJsonSerializeWithEnabledTrue(): void
    {
        $pseudoLocalization = new PseudoLocalization(true, 40);
        $result = $pseudoLocalization->jsonSerialize();

        $this->assertTrue($result['enabled']);
        $this->assertSame(40, $result['expansionPercentage']);
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $pseudoLocalization = new PseudoLocalization();
        $result = $pseudoLocalization->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('enabled', $result);
        $this->assertArrayNotHasKey('expansionPercentage', $result);
    }

    public function testJsonSerializeWithEnabledFalse(): void
    {
        $pseudoLocalization = new PseudoLocalization(false, 60);
        $result = $pseudoLocalization->jsonSerialize();

        $this->assertSame(60, $result['expansionPercentage']);
        $this->assertArrayNotHasKey('enabled', $result);
    }

    public function testJsonSerializeWithDefaultExpansionPercentage(): void
    {
        $pseudoLocalization = new PseudoLocalization(true, 30);
        $result = $pseudoLocalization->jsonSerialize();

        $this->assertTrue($result['enabled']);
        $this->assertArrayNotHasKey('expansionPercentage', $result);
    }

    public function testJsonSerializeWithNonDefaultExpansionPercentage(): void
    {
        $testCases = [0, 10, 25, 50, 75, 100, 150];

        foreach ($testCases as $percentage) {
            $pseudoLocalization = new PseudoLocalization(false, $percentage);
            $result = $pseudoLocalization->jsonSerialize();

            if ($percentage !== 30) {
                $this->assertArrayHasKey('expansionPercentage', $result);
                $this->assertSame($percentage, $result['expansionPercentage']);
            } else {
                $this->assertArrayNotHasKey('expansionPercentage', $result);
            }
        }
    }

    public function testJsonSerializeWithEnabledTrueAndDefaultExpansion(): void
    {
        $pseudoLocalization = new PseudoLocalization(true);
        $result = $pseudoLocalization->jsonSerialize();

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('enabled', $result);
        $this->assertTrue($result['enabled']);
        $this->assertArrayNotHasKey('expansionPercentage', $result);
    }

    public function testJsonSerializeWithEnabledFalseAndDefaultExpansion(): void
    {
        $pseudoLocalization = new PseudoLocalization(false);
        $result = $pseudoLocalization->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('enabled', $result);
        $this->assertArrayNotHasKey('expansionPercentage', $result);
    }

    public function testJsonSerializeWithBothNonDefaults(): void
    {
        $pseudoLocalization = new PseudoLocalization(true, 75);
        $result = $pseudoLocalization->jsonSerialize();

        $this->assertCount(2, $result);
        $this->assertArrayHasKey('enabled', $result);
        $this->assertArrayHasKey('expansionPercentage', $result);
        $this->assertTrue($result['enabled']);
        $this->assertSame(75, $result['expansionPercentage']);
    }

    public function testJsonSerializeWithZeroExpansionPercentage(): void
    {
        $pseudoLocalization = new PseudoLocalization(true, 0);
        $result = $pseudoLocalization->jsonSerialize();

        $this->assertTrue($result['enabled']);
        $this->assertSame(0, $result['expansionPercentage']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $pseudoLocalization = new PseudoLocalization();

        $this->assertInstanceOf(\JsonSerializable::class, $pseudoLocalization);
    }
}
