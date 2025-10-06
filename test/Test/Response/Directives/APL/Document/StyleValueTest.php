<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StyleValue;
use PHPUnit\Framework\TestCase;

class StyleValueTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $when = 'viewport.width > 100';
        $properties = ['color' => 'red', 'fontSize' => '16dp'];

        $styleValue = new StyleValue($when, $properties);

        $this->assertSame($when, $styleValue->when);
        $this->assertSame($properties, $styleValue->properties);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $styleValue = new StyleValue();

        $this->assertNull($styleValue->when);
        $this->assertSame([], $styleValue->properties);
    }

    public function testSetMethodWithRegularProperty(): void
    {
        $styleValue = new StyleValue();
        $result = $styleValue->set('color', 'blue');

        $this->assertSame($styleValue, $result);
        $this->assertSame('blue', $styleValue->properties['color']);
    }

    public function testSetMethodWithWhenProperty(): void
    {
        $styleValue = new StyleValue();
        $result = $styleValue->set('when', 'condition');

        $this->assertSame($styleValue, $result);
        $this->assertSame('condition', $styleValue->when);
        $this->assertArrayNotHasKey('when', $styleValue->properties);
    }

    public function testSetMethodWithNonStringWhenValue(): void
    {
        $styleValue = new StyleValue();
        $styleValue->set('when', 123);

        $this->assertNull($styleValue->when);
    }

    public function testSetMethodChaining(): void
    {
        $styleValue = new StyleValue();
        $result = $styleValue
            ->set('color', 'red')
            ->set('fontSize', '20dp')
            ->set('when', 'true');

        $this->assertSame($styleValue, $result);
        $this->assertSame('red', $styleValue->properties['color']);
        $this->assertSame('20dp', $styleValue->properties['fontSize']);
        $this->assertSame('true', $styleValue->when);
    }

    public function testJsonSerializeWithWhenAndProperties(): void
    {
        $styleValue = new StyleValue('condition', ['color' => 'green', 'opacity' => 0.5]);
        $result = $styleValue->jsonSerialize();

        $this->assertArrayHasKey('when', $result);
        $this->assertArrayHasKey('color', $result);
        $this->assertArrayHasKey('opacity', $result);
        $this->assertSame('condition', $result['when']);
        $this->assertSame('green', $result['color']);
        $this->assertSame(0.5, $result['opacity']);
    }

    public function testJsonSerializeWhenAppearsFirst(): void
    {
        $styleValue = new StyleValue('test', ['color' => 'blue', 'fontSize' => '14dp']);
        $result = $styleValue->jsonSerialize();

        $keys = array_keys($result);
        $this->assertSame('when', $keys[0]);
        $this->assertContains('color', $keys);
        $this->assertContains('fontSize', $keys);
    }

    public function testJsonSerializeWithoutWhen(): void
    {
        $styleValue = new StyleValue(null, ['color' => 'yellow', 'padding' => '10dp']);
        $result = $styleValue->jsonSerialize();

        $this->assertArrayNotHasKey('when', $result);
        $this->assertArrayHasKey('color', $result);
        $this->assertArrayHasKey('padding', $result);
        $this->assertSame('yellow', $result['color']);
        $this->assertSame('10dp', $result['padding']);
    }

    public function testJsonSerializeWithEmptyWhen(): void
    {
        $styleValue = new StyleValue('', ['color' => 'purple']);
        $result = $styleValue->jsonSerialize();

        $this->assertArrayNotHasKey('when', $result);
        $this->assertArrayHasKey('color', $result);
    }

    public function testJsonSerializeWithOnlyProperties(): void
    {
        $properties = ['margin' => '5dp', 'backgroundColor' => '#fff'];
        $styleValue = new StyleValue(null, $properties);
        $result = $styleValue->jsonSerialize();

        $this->assertSame($properties, $result);
    }

    public function testJsonSerializeWithEmptyProperties(): void
    {
        $styleValue = new StyleValue('condition', []);
        $result = $styleValue->jsonSerialize();

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('when', $result);
        $this->assertSame('condition', $result['when']);
    }

    public function testJsonSerializeWithMixedPropertyTypes(): void
    {
        $properties = [
            'string' => 'value',
            'number' => 42,
            'float' => 3.14,
            'boolean' => true,
            'array' => ['nested', 'array'],
        ];
        $styleValue = new StyleValue(null, $properties);
        $result = $styleValue->jsonSerialize();

        $this->assertSame('value', $result['string']);
        $this->assertSame(42, $result['number']);
        $this->assertSame(3.14, $result['float']);
        $this->assertTrue($result['boolean']);
        $this->assertSame(['nested', 'array'], $result['array']);
    }

    public function testSetOverwritesExistingProperty(): void
    {
        $styleValue = new StyleValue(null, ['color' => 'red']);
        $styleValue->set('color', 'blue');

        $this->assertSame('blue', $styleValue->properties['color']);
    }

    public function testSetOverwritesExistingWhen(): void
    {
        $styleValue = new StyleValue('original');
        $styleValue->set('when', 'updated');

        $this->assertSame('updated', $styleValue->when);
    }

    public function testImplementsJsonSerializable(): void
    {
        $styleValue = new StyleValue();

        $this->assertInstanceOf(\JsonSerializable::class, $styleValue);
    }
}
