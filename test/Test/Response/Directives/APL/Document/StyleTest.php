<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Style;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StyleValue;
use PHPUnit\Framework\TestCase;

class StyleTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $description = 'Test style';
        $extend = ['baseStyle', 'mixinStyle'];
        $extends = 'parentStyle';
        $value = $this->createMock(StyleValue::class);
        $values = [
            $this->createMock(StyleValue::class),
            $this->createMock(StyleValue::class),
        ];

        $style = new Style($description, $extend, $extends, $value, $values);

        $this->assertSame($description, $style->description);
        $this->assertSame($extend, $style->extend);
        $this->assertSame($extends, $style->extends);
        $this->assertSame($value, $style->value);
        $this->assertSame($values, $style->values);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $style = new Style();

        $this->assertNull($style->description);
        $this->assertNull($style->extend);
        $this->assertNull($style->extends);
        $this->assertNull($style->value);
        $this->assertNull($style->values);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $description = 'Complex style';
        $extend = ['style1', 'style2'];
        $extends = 'baseStyle';
        $value = $this->createMock(StyleValue::class);
        $values = [$this->createMock(StyleValue::class)];

        $style = new Style($description, $extend, $extends, $value, $values);
        $result = $style->jsonSerialize();

        $this->assertSame($description, $result['description']);
        $this->assertSame($extend, $result['extend']);
        $this->assertSame($extends, $result['extends']);
        $this->assertSame($value, $result['value']);
        $this->assertSame($values, $result['values']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $style = new Style();
        $result = $style->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('extend', $result);
        $this->assertArrayNotHasKey('extends', $result);
        $this->assertArrayNotHasKey('value', $result);
        $this->assertArrayNotHasKey('values', $result);
    }

    public function testJsonSerializeFiltersEmptyDescription(): void
    {
        $style = new Style('');
        $result = $style->jsonSerialize();

        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeFiltersEmptyExtend(): void
    {
        $style = new Style(null, []);
        $result = $style->jsonSerialize();

        $this->assertArrayNotHasKey('extend', $result);
    }

    public function testJsonSerializeFiltersEmptyExtends(): void
    {
        $style = new Style(null, null, '');
        $result = $style->jsonSerialize();

        $this->assertArrayNotHasKey('extends', $result);
    }

    public function testJsonSerializeFiltersEmptyValues(): void
    {
        $style = new Style(null, null, null, null, []);
        $result = $style->jsonSerialize();

        $this->assertArrayNotHasKey('values', $result);
    }

    public function testJsonSerializeWithNonEmptyDescription(): void
    {
        $style = new Style('Valid description');
        $result = $style->jsonSerialize();

        $this->assertArrayHasKey('description', $result);
        $this->assertSame('Valid description', $result['description']);
    }

    public function testJsonSerializeWithNonEmptyExtend(): void
    {
        $extend = ['parent1', 'parent2'];
        $style = new Style(null, $extend);
        $result = $style->jsonSerialize();

        $this->assertArrayHasKey('extend', $result);
        $this->assertSame($extend, $result['extend']);
    }

    public function testJsonSerializeWithNonEmptyExtends(): void
    {
        $style = new Style(null, null, 'parentStyle');
        $result = $style->jsonSerialize();

        $this->assertArrayHasKey('extends', $result);
        $this->assertSame('parentStyle', $result['extends']);
    }

    public function testJsonSerializeWithStyleValueInstance(): void
    {
        $value = $this->createMock(StyleValue::class);
        $style = new Style(null, null, null, $value);
        $result = $style->jsonSerialize();

        $this->assertArrayHasKey('value', $result);
        $this->assertSame($value, $result['value']);
    }

    public function testJsonSerializeWithNonEmptyValues(): void
    {
        $values = [
            $this->createMock(StyleValue::class),
            $this->createMock(StyleValue::class),
        ];
        $style = new Style(null, null, null, null, $values);
        $result = $style->jsonSerialize();

        $this->assertArrayHasKey('values', $result);
        $this->assertSame($values, $result['values']);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $extend = ['mixinStyle'];
        $value = $this->createMock(StyleValue::class);

        $style = new Style(null, $extend, null, $value);
        $result = $style->jsonSerialize();

        $this->assertArrayHasKey('extend', $result);
        $this->assertArrayHasKey('value', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('extends', $result);
        $this->assertArrayNotHasKey('values', $result);
        $this->assertSame($extend, $result['extend']);
        $this->assertSame($value, $result['value']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $style = new Style();

        $this->assertInstanceOf(\JsonSerializable::class, $style);
    }
}
