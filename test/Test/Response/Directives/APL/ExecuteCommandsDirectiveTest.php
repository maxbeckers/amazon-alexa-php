<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\ExecuteCommandsDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class ExecuteCommandsDirectiveTest extends TestCase
{
    public function testConstructorMinimal(): void
    {
        $cmd1 = $this->createMock(AbstractStandardCommand::class);
        $directive = new ExecuteCommandsDirective([$cmd1]);

        $json = $directive->jsonSerialize();
        $this->assertSame(ExecuteCommandsDirective::TYPE, $json['type']);
        $this->assertSame([$cmd1], $json['commands']);
        $this->assertArrayNotHasKey('token', $json);
        $this->assertArrayNotHasKey('presentationUri', $json);
    }

    public function testConstructorWithTokenAndUri(): void
    {
        $cmd1 = $this->createMock(AbstractStandardCommand::class);
        $cmd2 = $this->createMock(AbstractStandardCommand::class);
        $directive = new ExecuteCommandsDirective([$cmd1, $cmd2], 'token-1', 'widget://namespace/id');

        $json = $directive->jsonSerialize();
        $this->assertSame('token-1', $json['token']);
        $this->assertSame('widget://namespace/id', $json['presentationUri']);
        $this->assertCount(2, $json['commands']);
    }

    public function testAddCommand(): void
    {
        $directive = new ExecuteCommandsDirective([]);
        $c1 = $this->createMock(AbstractStandardCommand::class);
        $c2 = $this->createMock(AbstractStandardCommand::class);

        $directive->addCommand($c1);
        $directive->addCommand($c2);

        $json = $directive->jsonSerialize();
        $this->assertCount(2, $json['commands']);
        $this->assertSame($c1, $json['commands'][0]);
        $this->assertSame($c2, $json['commands'][1]);
    }
}
