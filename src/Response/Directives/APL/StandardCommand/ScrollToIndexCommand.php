<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ScrollAlign;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ScrollToIndexCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'ScrollToIndex';

    /**
     * @param string|null $componentId ID of the component to scroll
     * @param int|null $index Index to scroll to
     * @param ScrollAlign $align Alignment when scrolled to index
     * @param int|null $targetDuration Duration of the scroll animation in milliseconds
     */
    public function __construct(
        public ?string $componentId = null,
        public ?int $index = null,
        public ScrollAlign $align = ScrollAlign::VISIBLE,
        public ?int $targetDuration = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->index !== null) {
            $data['index'] = $this->index;
        }

        $data['align'] = $this->align->value;

        if ($this->targetDuration !== null) {
            $data['targetDuration'] = $this->targetDuration;
        }

        return $data;
    }
}
