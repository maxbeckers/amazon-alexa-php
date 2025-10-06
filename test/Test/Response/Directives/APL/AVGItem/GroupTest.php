<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\AVGItem;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem\Group;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;
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
}
