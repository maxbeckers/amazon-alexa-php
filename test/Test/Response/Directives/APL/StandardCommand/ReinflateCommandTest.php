<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\ReinflateCommand;
use PHPUnit\Framework\TestCase;

class ReinflateCommandTest extends TestCase
{
    public function testConstructorWithPreservedSequencers(): void
    {
        $preservedSequencers = ['sequencer1', 'sequencer2', 'sequencer3'];

        $command = new ReinflateCommand($preservedSequencers);

        $this->assertSame($preservedSequencers, $command->preservedSequencers);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $command = new ReinflateCommand();

        $this->assertNull($command->preservedSequencers);
    }

    public function testJsonSerializeWithPreservedSequencers(): void
    {
        $preservedSequencers = ['seq1', 'seq2'];

        $command = new ReinflateCommand($preservedSequencers);
        $result = $command->jsonSerialize();

        $this->assertSame(ReinflateCommand::TYPE, $result['type']);
        $this->assertSame($preservedSequencers, $result['preservedSequencers']);
    }

    public function testJsonSerializeWithEmptyArray(): void
    {
        $command = new ReinflateCommand([]);
        $result = $command->jsonSerialize();

        $this->assertSame(ReinflateCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('preservedSequencers', $result);
    }

    public function testJsonSerializeWithNullValue(): void
    {
        $command = new ReinflateCommand();
        $result = $command->jsonSerialize();

        $this->assertSame(ReinflateCommand::TYPE, $result['type']);
        $this->assertArrayNotHasKey('preservedSequencers', $result);
    }

    public function testJsonSerializeWithSingleSequencer(): void
    {
        $command = new ReinflateCommand(['onlySequencer']);
        $result = $command->jsonSerialize();

        $this->assertSame(ReinflateCommand::TYPE, $result['type']);
        $this->assertSame(['onlySequencer'], $result['preservedSequencers']);
    }

    public function testTypeConstant(): void
    {
        $this->assertSame('Reinflate', ReinflateCommand::TYPE);
    }
}
