<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Entity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $id = 'entity123';
        $type = 'person';
        $value = ['name' => 'John Doe', 'age' => 30];

        $entity = new Entity($id, $type, $value);

        $this->assertSame($id, $entity->id);
        $this->assertSame($type, $entity->type);
        $this->assertSame($value, $entity->value);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $entity = new Entity();

        $this->assertNull($entity->id);
        $this->assertNull($entity->type);
        $this->assertNull($entity->value);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $id = 'test-entity';
        $type = 'product';
        $value = 'Test Product';

        $entity = new Entity($id, $type, $value);
        $result = $entity->jsonSerialize();

        $this->assertSame($id, $result['id']);
        $this->assertSame($type, $result['type']);
        $this->assertSame($value, $result['value']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $entity = new Entity();
        $result = $entity->jsonSerialize();

        $this->assertArrayNotHasKey('id', $result);
        $this->assertArrayNotHasKey('type', $result);
        $this->assertArrayNotHasKey('value', $result);
        $this->assertEmpty($result);
    }

    public function testJsonSerializeWithDifferentValueTypes(): void
    {
        $testCases = [
            ['string value', 'string'],
            [123, 'integer'],
            [45.67, 'float'],
            [true, 'boolean'],
            [['nested' => 'array'], 'array'],
        ];

        foreach ($testCases as [$value, $description]) {
            $entity = new Entity('id', 'type', $value);
            $result = $entity->jsonSerialize();

            $this->assertSame($value, $result['value'], "Failed for $description");
        }
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $entity = new Entity('only-id');
        $result = $entity->jsonSerialize();

        $this->assertSame('only-id', $result['id']);
        $this->assertArrayNotHasKey('type', $result);
        $this->assertArrayNotHasKey('value', $result);
    }

    public function testJsonSerializeWithZeroAndFalseValues(): void
    {
        $entity = new Entity('id', 'type', 0);
        $result = $entity->jsonSerialize();

        $this->assertSame(0, $result['value']);

        $entity2 = new Entity('id', 'type', false);
        $result2 = $entity2->jsonSerialize();

        $this->assertFalse($result2['value']);
    }

    public function testJsonSerializeWithEmptyStringValue(): void
    {
        $entity = new Entity('id', 'type', '');
        $result = $entity->jsonSerialize();

        $this->assertSame('', $result['value']);
    }

    public function testImplementsJsonSerializable(): void
    {
        $entity = new Entity();

        $this->assertInstanceOf(\JsonSerializable::class, $entity);
    }
}
