<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SetPagePosition;

class SetPageCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'SetPage';

    /**
     * @param string|null $componentId ID of the component to set page on
     * @param SetPagePosition $position Position type for the page change
     * @param int|null $transitionDuration Duration of the page transition in milliseconds
     * @param int|null $value Page value to set
     */
    public function __construct(
        public ?string $componentId = null,
        public SetPagePosition $position = SetPagePosition::ABSOLUTE,
        public ?int $transitionDuration = null,
        public ?int $value = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        $data['position'] = $this->position->value;

        if ($this->transitionDuration !== null) {
            $data['transitionDuration'] = $this->transitionDuration;
        }

        if ($this->value !== null) {
            $data['value'] = $this->value;
        }

        return $data;
    }
}
