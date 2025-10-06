<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\MainTemplate;
use PHPUnit\Framework\TestCase;

class MainTemplateTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $parameters = ['param1', 'param2', 'param3'];
        $item = $this->createMock(APLBaseComponent::class);
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];

        $template = new MainTemplate($parameters, $item, $items);

        $this->assertSame($parameters, $template->parameters);
        $this->assertSame($item, $template->item);
        $this->assertSame($items, $template->items);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $template = new MainTemplate();

        $this->assertNull($template->parameters);
        $this->assertNull($template->item);
        $this->assertNull($template->items);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $parameters = ['width', 'height', 'theme'];
        $item = $this->createMock(APLBaseComponent::class);
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];

        $template = new MainTemplate($parameters, $item, $items);
        $result = $template->jsonSerialize();

        $this->assertSame($parameters, $result['parameters']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $template = new MainTemplate();
        $result = $template->jsonSerialize();

        $this->assertEmpty($result);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithOnlyParameters(): void
    {
        $parameters = ['color', 'size'];
        $template = new MainTemplate($parameters);
        $result = $template->jsonSerialize();

        $this->assertSame($parameters, $result['parameters']);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithOnlyItem(): void
    {
        $item = $this->createMock(APLBaseComponent::class);
        $template = new MainTemplate(null, $item);
        $result = $template->jsonSerialize();

        $this->assertSame($item, $result['item']);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('items', $result);
    }

    public function testJsonSerializeWithOnlyItems(): void
    {
        $items = [
            $this->createMock(APLBaseComponent::class),
            $this->createMock(APLBaseComponent::class),
        ];
        $template = new MainTemplate(null, null, $items);
        $result = $template->jsonSerialize();

        $this->assertSame($items, $result['items']);
        $this->assertArrayNotHasKey('parameters', $result);
        $this->assertArrayNotHasKey('item', $result);
    }

    public function testJsonSerializeWithSingleParameter(): void
    {
        $parameters = ['singleParam'];
        $template = new MainTemplate($parameters);
        $result = $template->jsonSerialize();

        $this->assertSame($parameters, $result['parameters']);
    }

    public function testJsonSerializeWithEmptyParametersArray(): void
    {
        $template = new MainTemplate([]);
        $result = $template->jsonSerialize();

        $this->assertSame([], $result['parameters']);
    }

    public function testJsonSerializeFiltersNullValues(): void
    {
        $item = $this->createMock(APLBaseComponent::class);
        $template = new MainTemplate(null, $item, null);
        $result = $template->jsonSerialize();

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('item', $result);
        $this->assertSame($item, $result['item']);
    }

    public function testJsonSerializeWithMixedContent(): void
    {
        $parameters = ['mixedParam1', 'mixedParam2'];
        $items = [$this->createMock(APLBaseComponent::class)];
        $template = new MainTemplate($parameters, null, $items);
        $result = $template->jsonSerialize();

        $this->assertSame($parameters, $result['parameters']);
        $this->assertSame($items, $result['items']);
        $this->assertArrayNotHasKey('item', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $template = new MainTemplate();

        $this->assertInstanceOf(\JsonSerializable::class, $template);
    }
}
