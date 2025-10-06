<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\ImportPackageCommand;
use PHPUnit\Framework\TestCase;

class ImportPackageCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $accept = 'application/json';
        $name = 'myPackage';
        $onFail = [$this->createMock(AbstractStandardCommand::class)];
        $onLoad = [$this->createMock(AbstractStandardCommand::class)];
        $source = 'https://example.com/package';
        $version = '1.0.0';

        $command = new ImportPackageCommand($accept, $name, $onFail, $onLoad, $source, $version);

        $this->assertSame($accept, $command->accept);
        $this->assertSame($name, $command->name);
        $this->assertSame($onFail, $command->onFail);
        $this->assertSame($onLoad, $command->onLoad);
        $this->assertSame($source, $command->source);
        $this->assertSame($version, $command->version);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new ImportPackageCommand();

        $this->assertNull($command->accept);
        $this->assertNull($command->name);
        $this->assertNull($command->onFail);
        $this->assertNull($command->onLoad);
        $this->assertNull($command->source);
        $this->assertNull($command->version);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $accept = 'text/plain';
        $name = 'testPackage';
        $onFail = [$this->createMock(AbstractStandardCommand::class)];
        $onLoad = [$this->createMock(AbstractStandardCommand::class)];
        $source = 'https://test.com/package';
        $version = '2.0.0';

        $command = new ImportPackageCommand($accept, $name, $onFail, $onLoad, $source, $version);
        $result = $command->jsonSerialize();

        $this->assertSame(ImportPackageCommand::TYPE, $result['type']);
        $this->assertSame($accept, $result['accept']);
        $this->assertSame($name, $result['name']);
        $this->assertSame($onFail, $result['onFail']);
        $this->assertSame($onLoad, $result['onLoad']);
        $this->assertSame($source, $result['source']);
        $this->assertSame($version, $result['version']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $command = new ImportPackageCommand(null, null, [], []);
        $result = $command->jsonSerialize();

        $this->assertArrayNotHasKey('onFail', $result);
        $this->assertArrayNotHasKey('onLoad', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new ImportPackageCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(ImportPackageCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('accept', $result);
        $this->assertArrayNotHasKey('name', $result);
        $this->assertArrayNotHasKey('onFail', $result);
        $this->assertArrayNotHasKey('onLoad', $result);
        $this->assertArrayNotHasKey('source', $result);
        $this->assertArrayNotHasKey('version', $result);
    }

    public function testJsonSerializeWithPartialProperties(): void
    {
        $command = new ImportPackageCommand('application/json', 'partial');
        $result = $command->jsonSerialize();

        $this->assertSame(ImportPackageCommand::TYPE, $result['type']);
        $this->assertSame('application/json', $result['accept']);
        $this->assertSame('partial', $result['name']);
        $this->assertArrayNotHasKey('onFail', $result);
        $this->assertArrayNotHasKey('onLoad', $result);
        $this->assertArrayNotHasKey('source', $result);
        $this->assertArrayNotHasKey('version', $result);
    }
}
