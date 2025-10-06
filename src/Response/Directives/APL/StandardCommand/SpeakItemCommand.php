<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\HighlightMode;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ScrollAlign;

class SpeakItemCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'SpeakItem';

    /**
     * @param string|null $componentId ID of the component to speak
     * @param ScrollAlign $align Alignment when scrolling to the item
     * @param HighlightMode $highlightMode How to highlight the item being spoken
     * @param int|null $minimumDwellTime Minimum time to dwell on each item in milliseconds
     */
    public function __construct(
        public ?string $componentId = null,
        public ScrollAlign $align = ScrollAlign::VISIBLE,
        public HighlightMode $highlightMode = HighlightMode::BLOCK,
        public ?int $minimumDwellTime = null,
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
        $data['highlightMode'] = $this->highlightMode->value;

        if ($this->minimumDwellTime !== null) {
            $data['minimumDwellTime'] = $this->minimumDwellTime;
        }

        return $data;
    }
}
