<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class AutoPageCommand extends AbstractStandardCommand
{
    public const TYPE = 'AutoPage';

    /**
     * @param string|null $componentId The ID of the component to auto-page
     * @param int|null $count Number of pages to advance
     * @param int|null $duration Duration of the auto-paging in milliseconds
     * @param int|null $transitionDuration Duration of each page transition in milliseconds
     */
    public function __construct(
        public ?string $componentId = null,
        public ?int $count = null,
        public ?int $duration = null,
        public ?int $transitionDuration = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->count !== null) {
            $data['count'] = $this->count;
        }

        if ($this->duration !== null) {
            $data['duration'] = $this->duration;
        }

        if ($this->transitionDuration !== null) {
            $data['transitionDuration'] = $this->transitionDuration;
        }

        return $data;
    }
}
