<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\BackgroundType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Gradient;
use PHPUnit\Framework\TestCase;

class GradientTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $colorRange = ['#ff0000', '#00ff00', '#0000ff'];
        $description = 'RGB gradient';
        $type = BackgroundType::RADIAL;
        $inputRange = [0.0, 0.5, 1.0];
        $angle = 45;

        $gradient = new Gradient($colorRange, $description, $type, $inputRange, $angle);

        $this->assertSame($colorRange, $gradient->colorRange);
        $this->assertSame($description, $gradient->description);
        $this->assertSame($type, $gradient->type);
        $this->assertSame($inputRange, $gradient->inputRange);
        $this->assertSame($angle, $gradient->angle);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $colorRange = ['#000000', '#ffffff'];

        $gradient = new Gradient($colorRange);

        $this->assertSame($colorRange, $gradient->colorRange);
        $this->assertSame('', $gradient->description);
        $this->assertSame(BackgroundType::LINEAR, $gradient->type);
        $this->assertSame([], $gradient->inputRange);
        $this->assertSame(0, $gradient->angle);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $colorRange = ['red', 'blue'];
        $description = 'Test gradient';
        $type = BackgroundType::RADIAL;
        $inputRange = [0.0, 1.0];
        $angle = 90;

        $gradient = new Gradient($colorRange, $description, $type, $inputRange, $angle);
        $result = $gradient->jsonSerialize();

        $this->assertSame($description, $result['description']);
        $this->assertSame($colorRange, $result['colorRange']);
        $this->assertSame($angle, $result['angle']);
        $this->assertSame($type, $result['type']);
        $this->assertSame($inputRange, $result['inputRange']);
    }

    public function testJsonSerializeWithEmptyInputRange(): void
    {
        $colorRange = ['#ff0000', '#00ff00'];
        $gradient = new Gradient($colorRange, 'test', BackgroundType::LINEAR, []);
        $result = $gradient->jsonSerialize();

        $this->assertArrayNotHasKey('inputRange', $result);
    }

    public function testJsonSerializeWithNullInputRange(): void
    {
        $colorRange = ['#ff0000', '#00ff00'];
        $gradient = new Gradient($colorRange, 'test', BackgroundType::LINEAR, null);
        $result = $gradient->jsonSerialize();

        $this->assertArrayNotHasKey('inputRange', $result);
    }

    public function testJsonSerializeWithValidInputRange(): void
    {
        $colorRange = ['#ff0000', '#00ff00'];
        $inputRange = [0.0, 0.3, 1.0];
        $gradient = new Gradient($colorRange, 'test', BackgroundType::LINEAR, $inputRange);
        $result = $gradient->jsonSerialize();

        $this->assertArrayHasKey('inputRange', $result);
        $this->assertSame($inputRange, $result['inputRange']);
    }

    public function testJsonSerializeWithDifferentBackgroundTypes(): void
    {
        $colorRange = ['black', 'white'];
        $types = [BackgroundType::LINEAR, BackgroundType::RADIAL];

        foreach ($types as $type) {
            $gradient = new Gradient($colorRange, '', $type);
            $result = $gradient->jsonSerialize();

            $this->assertSame($type, $result['type']);
        }
    }

    public function testJsonSerializeWithDefaultValues(): void
    {
        $colorRange = ['#123456'];
        $gradient = new Gradient($colorRange);
        $result = $gradient->jsonSerialize();

        $this->assertSame('', $result['description']);
        $this->assertSame($colorRange, $result['colorRange']);
        $this->assertSame(0, $result['angle']);
        $this->assertSame(BackgroundType::LINEAR, $result['type']);
        $this->assertArrayNotHasKey('inputRange', $result);
    }

    public function testJsonSerializeStructure(): void
    {
        $gradient = new Gradient(['red'], 'test', BackgroundType::LINEAR, [0.0, 1.0], 180);
        $result = $gradient->jsonSerialize();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('colorRange', $result);
        $this->assertArrayHasKey('angle', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('inputRange', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $gradient = new Gradient(['color']);

        $this->assertInstanceOf(\JsonSerializable::class, $gradient);
    }
}
