<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

class ReinflateCommand extends AbstractStandardCommand
{
    public const TYPE = 'Reinflate';

    /**
     * @param string[]|null $preservedSequencers Array of sequencer names to preserve
     */
    public function __construct(
        public ?array $preservedSequencers = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->preservedSequencers !== null && !empty($this->preservedSequencers)) {
            $data['preservedSequencers'] = $this->preservedSequencers;
        }

        return $data;
    }
}
