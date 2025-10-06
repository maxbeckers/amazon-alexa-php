<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Gradient;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Resource;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $gradient = $this->createMock(Gradient::class);
        $gradients = ['gradient1' => $this->createMock(Gradient::class)];
        $booleans = ['flag1' => true, 'flag2' => false];
        $colors = ['primary' => '#ff0000', 'secondary' => '#00ff00'];
        $dimensions = ['width' => '100dp', 'height' => '200dp'];
        $easings = ['smooth' => 'ease-in-out', 'fast' => 'linear'];
        $numbers = ['count' => '10', 'ratio' => '1.5'];
        $strings = ['title' => 'Hello', 'subtitle' => 'World'];

        $resource = new Resource(
            boolean: true,
            booleans: $booleans,
            color: '#123456',
            colors: $colors,
            description: 'Test resource',
            dimension: '50dp',
            dimensions: $dimensions,
            easing: 'ease-in',
            easings: $easings,
            gradient: $gradient,
            gradients: $gradients,
            number: '42',
            numbers: $numbers,
            string: 'test string',
            strings: $strings,
            when: 'condition'
        );

        $this->assertTrue($resource->boolean);
        $this->assertSame($booleans, $resource->booleans);
        $this->assertSame('#123456', $resource->color);
        $this->assertSame($colors, $resource->colors);
        $this->assertSame('Test resource', $resource->description);
        $this->assertSame('50dp', $resource->dimension);
        $this->assertSame($dimensions, $resource->dimensions);
        $this->assertSame('ease-in', $resource->easing);
        $this->assertSame($easings, $resource->easings);
        $this->assertSame($gradient, $resource->gradient);
        $this->assertSame($gradients, $resource->gradients);
        $this->assertSame('42', $resource->number);
        $this->assertSame($numbers, $resource->numbers);
        $this->assertSame('test string', $resource->string);
        $this->assertSame($strings, $resource->strings);
        $this->assertSame('condition', $resource->when);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $resource = new Resource();

        $this->assertNull($resource->boolean);
        $this->assertNull($resource->booleans);
        $this->assertNull($resource->color);
        $this->assertNull($resource->colors);
        $this->assertNull($resource->description);
        $this->assertNull($resource->dimension);
        $this->assertNull($resource->dimensions);
        $this->assertNull($resource->easing);
        $this->assertNull($resource->easings);
        $this->assertNull($resource->gradient);
        $this->assertNull($resource->gradients);
        $this->assertNull($resource->number);
        $this->assertNull($resource->numbers);
        $this->assertNull($resource->string);
        $this->assertNull($resource->strings);
        $this->assertNull($resource->when);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $gradient = $this->createMock(Gradient::class);
        $gradients = ['grad1' => $this->createMock(Gradient::class)];
        $booleans = ['active' => true];
        $colors = ['primary' => '#blue'];
        $dimensions = ['size' => '100px'];
        $easings = ['smooth' => 'ease'];
        $numbers = ['value' => '5'];
        $strings = ['name' => 'test'];

        $resource = new Resource(
            boolean: false,
            booleans: $booleans,
            color: '#red',
            colors: $colors,
            description: 'Full resource',
            dimension: '25dp',
            dimensions: $dimensions,
            easing: 'linear',
            easings: $easings,
            gradient: $gradient,
            gradients: $gradients,
            number: '100',
            numbers: $numbers,
            string: 'full string',
            strings: $strings,
            when: 'true'
        );

        $result = $resource->jsonSerialize();

        $this->assertFalse($result['boolean']);
        $this->assertSame($booleans, $result['booleans']);
        $this->assertSame('#red', $result['color']);
        $this->assertSame($colors, $result['colors']);
        $this->assertSame('Full resource', $result['description']);
        $this->assertSame('25dp', $result['dimension']);
        $this->assertSame($dimensions, $result['dimensions']);
        $this->assertSame('linear', $result['easing']);
        $this->assertSame($easings, $result['easings']);
        $this->assertSame($gradient, $result['gradient']);
        $this->assertSame($gradients, $result['gradients']);
        $this->assertSame('100', $result['number']);
        $this->assertSame($numbers, $result['numbers']);
        $this->assertSame('full string', $result['string']);
        $this->assertSame($strings, $result['strings']);
        $this->assertSame('true', $result['when']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $resource = new Resource();
        $result = $resource->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('boolean', $result);
        $this->assertArrayNotHasKey('booleans', $result);
        $this->assertArrayNotHasKey('color', $result);
        $this->assertArrayNotHasKey('colors', $result);
        $this->assertArrayNotHasKey('description', $result);
        $this->assertArrayNotHasKey('dimension', $result);
        $this->assertArrayNotHasKey('dimensions', $result);
        $this->assertArrayNotHasKey('easing', $result);
        $this->assertArrayNotHasKey('easings', $result);
        $this->assertArrayNotHasKey('gradient', $result);
        $this->assertArrayNotHasKey('gradients', $result);
        $this->assertArrayNotHasKey('number', $result);
        $this->assertArrayNotHasKey('numbers', $result);
        $this->assertArrayNotHasKey('string', $result);
        $this->assertArrayNotHasKey('strings', $result);
        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeFiltersEmptyArrays(): void
    {
        $resource = new Resource(
            booleans: [],
            colors: [],
            dimensions: [],
            easings: [],
            gradients: [],
            numbers: [],
            strings: []
        );
        $result = $resource->jsonSerialize();

        $this->assertArrayNotHasKey('booleans', $result);
        $this->assertArrayNotHasKey('colors', $result);
        $this->assertArrayNotHasKey('dimensions', $result);
        $this->assertArrayNotHasKey('easings', $result);
        $this->assertArrayNotHasKey('gradients', $result);
        $this->assertArrayNotHasKey('numbers', $result);
        $this->assertArrayNotHasKey('strings', $result);
    }

    public function testJsonSerializeFiltersEmptyDescription(): void
    {
        $resource = new Resource(description: '');
        $result = $resource->jsonSerialize();

        $this->assertArrayNotHasKey('description', $result);
    }

    public function testJsonSerializeIncludesBooleanFalse(): void
    {
        $resource = new Resource(boolean: false);
        $result = $resource->jsonSerialize();

        $this->assertArrayHasKey('boolean', $result);
        $this->assertFalse($result['boolean']);
    }

    public function testJsonSerializeIncludesBooleanTrue(): void
    {
        $resource = new Resource(boolean: true);
        $result = $resource->jsonSerialize();

        $this->assertArrayHasKey('boolean', $result);
        $this->assertTrue($result['boolean']);
    }

    public function testJsonSerializeWithWhenCondition(): void
    {
        $resource = new Resource(when: 'viewport.width > 100');
        $result = $resource->jsonSerialize();

        $this->assertArrayHasKey('when', $result);
        $this->assertSame('viewport.width > 100', $result['when']);
    }

    public function testJsonSerializeWithNonEmptyArrays(): void
    {
        $booleans = ['test' => true];
        $colors = ['primary' => '#000'];
        $dimensions = ['width' => '10dp'];
        $easings = ['name' => 'ease'];
        $gradients = ['grad' => $this->createMock(Gradient::class)];
        $numbers = ['num' => '1'];
        $strings = ['str' => 'value'];

        $resource = new Resource(
            booleans: $booleans,
            colors: $colors,
            dimensions: $dimensions,
            easings: $easings,
            gradients: $gradients,
            numbers: $numbers,
            strings: $strings
        );
        $result = $resource->jsonSerialize();

        $this->assertArrayHasKey('booleans', $result);
        $this->assertArrayHasKey('colors', $result);
        $this->assertArrayHasKey('dimensions', $result);
        $this->assertArrayHasKey('easings', $result);
        $this->assertArrayHasKey('gradients', $result);
        $this->assertArrayHasKey('numbers', $result);
        $this->assertArrayHasKey('strings', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $resource = new Resource();

        $this->assertInstanceOf(\JsonSerializable::class, $resource);
    }
}
