<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\AVGItem;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\Group;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGFilter\AVGFilter;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $clipPath = 'circle(50%)';
        $data = ['key1' => 'value1', 'key2' => 'value2'];
        $item = $this->createMock(AVGItem::class);
        $items = [
            $this->createMock(AVGItem::class),
            $this->createMock(AVGItem::class),
        ];
        $opacity = 0.8;
        $transform = 'translate(10, 20)';

        $group = new Group($clipPath, $data, $item, $items, $opacity, $transform);

        $this->assertSame($clipPath, $group->clipPath);
        $this->assertSame($data, $group->data);
        $this->assertSame($item, $group->item);
        $this->assertSame($items, $group->items);
        $this->assertSame($opacity, $group->opacity);
        $this->assertSame($transform, $group->transform);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $group = new Group();

        $this->assertNull($group->clipPath);
        $this->assertNull($group->data);
        $this->assertNull($group->item);
        $this->assertNull($group->items);
        $this->assertNull($group->opacity);
        $this->assertNull($group->transform);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $clipPath = 'rect(10%, 20%, 30%, 40%)';
        $data = ['width' => 100, 'height' => 200];
        $item = $this->createMock(AVGItem::class);
        $items = [
            $this->createMock(AVGItem::class),
            $this->createMock(AVGItem::class),
        ];
        $opacity = 0.5;
        $transform = 'scale(2, 2)';

        $group = new Group($clipPath, $data, $item, $items, $opacity, $transform);
        $result = $group->jsonSerialize();

        $this->assertSame(AVGItemType::GROUP->value, $result['type']);
        $this->assertSame($clipPath, $result['clipPath']);
        $this->assertSame($data, $result['data']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
        $this->assertSame($opacity, $result['opacity']);
        $this->assertSame($transform, $result['transform']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $group = new Group();
        $result = $group->jsonSerialize();

        $this->assertSame(AVGItemType::GROUP->value, $result['type']);
        $this->assertArrayNotHasKey('clipPath', $result);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('opacity', $result);
        $this->assertArrayNotHasKey('transform', $result);
    }

    public function testJsonSerializeWithEmptyData(): void
    {
        $group = new Group(data: []);
        $result = $group->jsonSerialize();

        $this->assertArrayNotHasKey('data', $result);
    }

    public function testJsonSerializeWithEmptyItems(): void
    {
        $group = new Group(items: []);
        $result = $group->jsonSerialize();

        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $group = new Group(
            clipPath: 'polygon(0% 0%, 100% 0%, 50% 100%)',
            opacity: 1.0
        );
        $result = $group->jsonSerialize();

        $this->assertSame(AVGItemType::GROUP->value, $result['type']);
        $this->assertSame('polygon(0% 0%, 100% 0%, 50% 100%)', $result['clipPath']);
        $this->assertSame(1.0, $result['opacity']);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('transform', $result);
    }

    public function testJsonSerializeWithZeroOpacity(): void
    {
        $group = new Group(opacity: 0.0);
        $result = $group->jsonSerialize();

        $this->assertArrayHasKey('opacity', $result);
        $this->assertSame(0.0, $result['opacity']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame(AVGItemType::GROUP, Group::TYPE);
    }

    public function testExtendsAVGItem(): void
    {
        $group = new Group();

        $this->assertInstanceOf(AVGItem::class, $group);
    }

    public function testImplementsJsonSerializable(): void
    {
        $group = new Group();

        $this->assertInstanceOf(\JsonSerializable::class, $group);
    }

    /**
     * Ensure every public property inherited from AVGItem (and present on Group) is serialized
     * when assigned a non-default non-empty value, using type-aware assignments to avoid
     * invalid TypeErrors (e.g. assigning string to ?array).
     */
    public function testJsonSerializeIncludesAllAVGItemBaseProperties(): void
    {
        $group = new Group();

        $reflection  = new \ReflectionObject($group);
        $properties  = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
        $skip        = ['type']; // type always handled by base

        $assigned = [];

        foreach ($properties as $prop) {
            $name = $prop->getName();
            if (in_array($name, $skip, true)) {
                continue;
            }

            // Special handling for typed AVGItem property (object mock).
            if ($name === 'item') {
                $value = $this->createMock(AVGItem::class);
                $group->$name = $value;
                $assigned[$name] = $value;
                continue;
            }

            // Special handling for AVGFilter-typed property.
            if ($name === 'filter') {
                $value = $this->createMock(AVGFilter::class);
                $group->$name = $value;
                $assigned[$name] = $value;
                continue;
            }

            $current = $group->$name ?? null;
            $value   = $this->generateValueForProperty($prop, $current, $name);

            // If generator decides to skip (returns a sentinel null and property already null) we move on.
            if ($value !== null) {
                $group->$name    = $value;
                $assigned[$name] = $value;
            }
        }

        $json = $group->jsonSerialize();
        $this->assertSame(AVGItemType::GROUP->value, $json['type']);

        foreach ($assigned as $prop => $value) {
            // Skip default-like values that component intentionally filters out
            if ($value === null) {
                continue;
            }
            if (is_array($value) && $value === []) {
                continue;
            }
            if ((is_int($value) && $value === 0) || (is_string($value) && $value === '') || (is_float($value) && $value === 0.0)) {
                continue;
            }

            $this->assertArrayHasKey($prop, $json, "Expected property '$prop' to be serialized after assignment.");
            if (array_key_exists($prop, $json)) {
                $this->assertSame($value, $json[$prop], "Serialized value mismatch for property '$prop'");
            }
        }
    }

    /**
     * Generate a type-compatible non-default value for the given property.
     *
     * @return mixed
     */
    private function generateValueForProperty(\ReflectionProperty $prop, mixed $current, string $name): mixed
    {
        $type = $prop->getType();
        if ($type instanceof \ReflectionUnionType) {
            // Fallback: leave as-is for union types to avoid complex branching.
            return $current ?? 'u-' . $name;
        }

        if ($type instanceof \ReflectionNamedType) {
            $typeName = $type->getName();
            $allowsNull = $type->allowsNull();

            // Handle scalar / array / object typed properties explicitly
            switch ($typeName) {
                case 'array':
                    // If already non-empty keep; else supply non-empty array
                    return (is_array($current) && $current !== []) ? $current : [$name => 'val'];
                case 'int':
                    return ($current !== null && $current !== 0) ? $current : 101;
                case 'float':
                    return ($current !== null && $current !== 0.0) ? $current : 0.77;
                case 'bool':
                    return ($current !== null) ? !$current : true;
                case 'string':
                    return ($current !== null && $current !== '') ? $current : 'str-' . $name;
                default:
                    // Object (other than AVGItem handled earlier) or untyped fallback
                    if ($current !== null) {
                        return $current;
                    }
                    // For nullable array-like properties (?array) etc
                    if ($typeName === 'array') {
                        return [$name => 'val'];
                    }
                    // If it's a class we can't easily mock generically—return dummy string if allowed
                    if ($allowsNull) {
                        return 'obj-' . $name;
                    }

                    return 'obj-' . $name;
            }
        }

        // No type info (legacy) -> attempt heuristic similar to earlier code
        if ($current !== null) {
            return $current;
        }

        if (preg_match('/(items?|children|data|array|values)/i', $name)) {
            return [$name => 'val'];
        }
        if (preg_match('/(opacity)/i', $name)) {
            return 0.42;
        }
        if (preg_match('/(width|height|radius|length|count|size|index)/i', $name)) {
            return 202;
        }
        if (preg_match('/(path|transform|clip|color|stroke|fill|text)/i', $name)) {
            return $name . '-value';
        }

        return 'x-' . $name;
    }
}
