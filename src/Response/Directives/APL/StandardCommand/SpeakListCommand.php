<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ScrollAlign;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class SpeakListCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'SpeakList';

    /**
     * @param string|null $componentId ID of the component to speak
     * @param ScrollAlign $align Alignment when scrolling to items
     * @param int|null $count Number of items to speak
     * @param int|null $minimumDwellTime Minimum time to dwell on each item in milliseconds
     * @param int|null $start Starting index for speaking
     */
    public function __construct(
        public ?string $componentId = null,
        public ScrollAlign $align = ScrollAlign::VISIBLE,
        public ?int $count = null,
        public ?int $minimumDwellTime = null,
        public ?int $start = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        $data['align'] = $this->align->value;

        if ($this->count !== null) {
            $data['count'] = $this->count;
        }

        if ($this->minimumDwellTime !== null) {
            $data['minimumDwellTime'] = $this->minimumDwellTime;
        }

        if ($this->start !== null) {
            $data['start'] = $this->start;
        }

        return $data;
    }
}
