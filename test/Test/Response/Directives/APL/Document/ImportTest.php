<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Import;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ImportType;
use PHPUnit\Framework\TestCase;

class ImportTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $name = 'testPackage';
        $version = '1.0.0';
        $accept = 'application/json';
        $loadAfter = ['package1', 'package2'];
        $source = 'https://example.com/package';
        $type = ImportType::ALL_OF;
        $when = false;

        $import = new Import($name, $version, $accept, $loadAfter, $source, $type, $when);

        $this->assertSame($name, $import->name);
        $this->assertSame($version, $import->version);
        $this->assertSame($accept, $import->accept);
        $this->assertSame($loadAfter, $import->loadAfter);
        $this->assertSame($source, $import->source);
        $this->assertSame($type, $import->type);
        $this->assertFalse($import->when);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $name = 'myPackage';
        $version = '2.0.0';

        $import = new Import($name, $version);

        $this->assertSame($name, $import->name);
        $this->assertSame($version, $import->version);
        $this->assertNull($import->accept);
        $this->assertNull($import->loadAfter);
        $this->assertNull($import->source);
        $this->assertNull($import->type);
        $this->assertTrue($import->when);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $name = 'fullPackage';
        $version = '1.2.3';
        $accept = 'text/plain';
        $loadAfter = ['dep1', 'dep2'];
        $source = 'https://test.com/pkg';
        $type = ImportType::ALL_OF;
        $when = false;

        $import = new Import($name, $version, $accept, $loadAfter, $source, $type, $when);
        $result = $import->jsonSerialize();

        $this->assertSame($name, $result['name']);
        $this->assertSame($version, $result['version']);
        $this->assertSame($accept, $result['accept']);
        $this->assertSame($loadAfter, $result['loadAfter']);
        $this->assertSame($source, $result['source']);
        $this->assertSame($type->value, $result['type']);
        $this->assertFalse($result['when']);
    }

    public function testJsonSerializeWithMinimalProperties(): void
    {
        $import = new Import('minimal', '1.0');
        $result = $import->jsonSerialize();

        $this->assertSame('minimal', $result['name']);
        $this->assertSame('1.0', $result['version']);
        $this->assertArrayNotHasKey('accept', $result);
        $this->assertArrayNotHasKey('loadAfter', $result);
        $this->assertArrayNotHasKey('source', $result);
        $this->assertArrayNotHasKey('type', $result);
        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeFiltersEmptyAccept(): void
    {
        $import = new Import('test', '1.0', '');
        $result = $import->jsonSerialize();

        $this->assertArrayNotHasKey('accept', $result);
    }

    public function testJsonSerializeFiltersEmptyLoadAfter(): void
    {
        $import = new Import('test', '1.0', null, []);
        $result = $import->jsonSerialize();

        $this->assertArrayNotHasKey('loadAfter', $result);
    }

    public function testJsonSerializeFiltersEmptySource(): void
    {
        $import = new Import('test', '1.0', null, null, '');
        $result = $import->jsonSerialize();

        $this->assertArrayNotHasKey('source', $result);
    }

    public function testJsonSerializeIncludesWhenFalse(): void
    {
        $import = new Import('test', '1.0', when: false);
        $result = $import->jsonSerialize();

        $this->assertArrayHasKey('when', $result);
        $this->assertFalse($result['when']);
    }

    public function testJsonSerializeExcludesWhenTrue(): void
    {
        $import = new Import('test', '1.0', when: true);
        $result = $import->jsonSerialize();

        $this->assertArrayNotHasKey('when', $result);
    }

    public function testJsonSerializeWithNonEmptyAccept(): void
    {
        $import = new Import('test', '1.0', 'application/json');
        $result = $import->jsonSerialize();

        $this->assertArrayHasKey('accept', $result);
        $this->assertSame('application/json', $result['accept']);
    }

    public function testJsonSerializeWithNonEmptyLoadAfter(): void
    {
        $loadAfter = ['dependency1', 'dependency2'];
        $import = new Import('test', '1.0', null, $loadAfter);
        $result = $import->jsonSerialize();

        $this->assertArrayHasKey('loadAfter', $result);
        $this->assertSame($loadAfter, $result['loadAfter']);
    }

    public function testJsonSerializeWithNonEmptySource(): void
    {
        $import = new Import('test', '1.0', null, null, 'https://source.com');
        $result = $import->jsonSerialize();

        $this->assertArrayHasKey('source', $result);
        $this->assertSame('https://source.com', $result['source']);
    }

    public function testJsonSerializeWithImportType(): void
    {
        $import = new Import('test', '1.0', type: ImportType::ALL_OF);
        $result = $import->jsonSerialize();

        $this->assertArrayHasKey('type', $result);
        $this->assertSame(ImportType::ALL_OF->value, $result['type']);
    }

    public function testJsonSerializeStructure(): void
    {
        $import = new Import('test', '1.0');
        $result = $import->jsonSerialize();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('version', $result);
    }

    public function testImplementsJsonSerializable(): void
    {
        $import = new Import('test', '1.0');

        $this->assertInstanceOf(\JsonSerializable::class, $import);
    }
}
