<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\ClearFocusCommand;
use PHPUnit\Framework\TestCase;

class ClearFocusCommandTest extends TestCase
{
    public function testConstructor(): void
    {
        $command = new ClearFocusCommand();

        $this->assertInstanceOf(ClearFocusCommand::class, $command);
    }

    public function testJsonSerialize(): void
    {
        $command = new ClearFocusCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(ClearFocusCommand::TYPE, $result['type']);
        $this->assertCount(1, $result);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('ClearFocus', ClearFocusCommand::TYPE);
    }
}
