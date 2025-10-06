<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\FinishCommand;
use PHPUnit\Framework\TestCase;

class FinishCommandTest extends TestCase
{
    public function testConstructor(): void
    {
        $command = new FinishCommand();

        $this->assertInstanceOf(FinishCommand::class, $command);
    }

    public function testJsonSerialize(): void
    {
        $command = new FinishCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(FinishCommand::TYPE, $result['type']);
        $this->assertCount(1, $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('Finish', FinishCommand::TYPE);
    }
}
