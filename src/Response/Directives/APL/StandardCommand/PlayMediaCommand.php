<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Request\AudioTrack;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class PlayMediaCommand extends AbstractStandardCommand
{
    public const TYPE = 'PlayMedia';

    /**
     * @param string|null $componentId ID of the component to play media on
     * @param string|array|null $source Media source URL or array of sources
     * @param AudioTrack|null $audioTrack Audio track to play on
     */
    public function __construct(
        public ?string $componentId = null,
        public string|array|null $source = null,
        public ?AudioTrack $audioTrack = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->source !== null) {
            $data['source'] = $this->source;
        }

        if ($this->audioTrack !== null) {
            $data['audioTrack'] = $this->audioTrack->value;
        }

        return $data;
    }
}
