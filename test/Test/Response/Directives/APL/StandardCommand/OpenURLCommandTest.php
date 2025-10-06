<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\OpenURLCommand;
use PHPUnit\Framework\TestCase;

class OpenURLCommandTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $source = 'https://example.com';
        $onFail = $this->createMock(AbstractStandardCommand::class);

        $command = new OpenURLCommand($source, $onFail);

        $this->assertSame($source, $command->source);
        $this->assertSame($onFail, $command->onFail);
    }

    public function testConstructorWithArrayOfCommands(): void
    {
        $source = 'https://test.com';
        $onFail = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];

        $command = new OpenURLCommand($source, $onFail);

        $this->assertSame($source, $command->source);
        $this->assertSame($onFail, $command->onFail);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new OpenURLCommand();

        $this->assertNull($command->source);
        $this->assertNull($command->onFail);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $source = 'https://example.org';
        $onFail = $this->createMock(AbstractStandardCommand::class);

        $command = new OpenURLCommand($source, $onFail);
        $result = $command->jsonSerialize();

        $this->assertSame(OpenURLCommand::TYPE, $result['type']);
        $this->assertSame($source, $result['source']);
        $this->assertSame($onFail, $result['onFail']);
    }

    public function testJsonSerializeWithArrayOfCommands(): void
    {
        $source = 'https://test.org';
        $onFail = [
            $this->createMock(AbstractStandardCommand::class),
            $this->createMock(AbstractStandardCommand::class),
        ];

        $command = new OpenURLCommand($source, $onFail);
        $result = $command->jsonSerialize();

        $this->assertSame(OpenURLCommand::TYPE, $result['type']);
        $this->assertSame($source, $result['source']);
        $this->assertSame($onFail, $result['onFail']);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $command = new OpenURLCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(OpenURLCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('source', $result);
        $this->assertArrayNotHasKey('onFail', $result);
    }

    public function testJsonSerializeWithSourceOnly(): void
    {
        $command = new OpenURLCommand('https://only-source.com');
        $result = $command->jsonSerialize();

        $this->assertSame(OpenURLCommand::TYPE, $result['type']);
        $this->assertSame('https://only-source.com', $result['source']);
        $this->assertArrayNotHasKey('onFail', $result);
    }
}
