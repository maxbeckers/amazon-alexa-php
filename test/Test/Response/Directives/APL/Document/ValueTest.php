<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Value;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $property = 'opacity';
        $to = 1.0;
        $from = 0.5;

        $value = new Value($property, $to, $from);

        $this->assertSame($property, $value->property);
        $this->assertSame($to, $value->to);
        $this->assertSame($from, $value->from);
    }

    public function testConstructorWithDefaultFrom(): void
    {
        $property = 'translateX';
        $to = 100;

        $value = new Value($property, $to);

        $this->assertSame($property, $value->property);
        $this->assertSame($to, $value->to);
        $this->assertNull($value->from);
    }

    public function testConstructorWithIntegerValues(): void
    {
        $value = new Value('width', 200, 150);

        $this->assertSame('width', $value->property);
        $this->assertSame(200, $value->to);
        $this->assertSame(150, $value->from);
    }

    public function testConstructorWithFloatValues(): void
    {
        $value = new Value('scale', 1.5, 0.8);

        $this->assertSame('scale', $value->property);
        $this->assertSame(1.5, $value->to);
        $this->assertSame(0.8, $value->from);
    }

    public function testConstructorWithMixedNumericTypes(): void
    {
        $value = new Value('rotation', 90.0, 45);

        $this->assertSame('rotation', $value->property);
        $this->assertSame(90.0, $value->to);
        $this->assertSame(45, $value->from);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $value = new Value('height', 300, 100);
        $result = $value->jsonSerialize();

        $this->assertSame('height', $result['property']);
        $this->assertSame(100, $result['from']);
        $this->assertSame(300, $result['to']);
    }

    public function testJsonSerializeWithoutFrom(): void
    {
        $value = new Value('opacity', 0.0);
        $result = $value->jsonSerialize();

        $this->assertSame('opacity', $result['property']);
        $this->assertSame(0.0, $result['to']);
        $this->assertArrayNotHasKey('from', $result);
    }

    public function testJsonSerializeWithNullFrom(): void
    {
        $value = new Value('translateY', 50, null);
        $result = $value->jsonSerialize();

        $this->assertSame('translateY', $result['property']);
        $this->assertSame(50, $result['to']);
        $this->assertArrayNotHasKey('from', $result);
    }

    public function testJsonSerializePropertyOrder(): void
    {
        $value = new Value('scaleX', 2.0, 1.0);
        $result = $value->jsonSerialize();

        $keys = array_keys($result);
        $this->assertSame('property', $keys[0]);
        $this->assertSame('from', $keys[1]);
        $this->assertSame('to', $keys[2]);
    }

    public function testJsonSerializeWithZeroValues(): void
    {
        $value = new Value('margin', 0, 0);
        $result = $value->jsonSerialize();

        $this->assertSame('margin', $result['property']);
        $this->assertSame(0, $result['from']);
        $this->assertSame(0, $result['to']);
    }

    public function testJsonSerializeWithNegativeValues(): void
    {
        $value = new Value('translateX', -100, -50);
        $result = $value->jsonSerialize();

        $this->assertSame('translateX', $result['property']);
        $this->assertSame(-50, $result['from']);
        $this->assertSame(-100, $result['to']);
    }

    public function testJsonSerializeWithFloatPrecision(): void
    {
        $value = new Value('opacity', 0.123456, 0.987654);
        $result = $value->jsonSerialize();

        $this->assertSame('opacity', $result['property']);
        $this->assertSame(0.987654, $result['from']);
        $this->assertSame(0.123456, $result['to']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $value = new Value('property', 1);

        $this->assertInstanceOf(\JsonSerializable::class, $value);
    }
}
