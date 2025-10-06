<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\RepeatMode;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Value;

class AnimateItemCommand extends AbstractStandardCommand
{
    public const TYPE = 'AnimateItem';

    /**
     * @param string|null $componentId The ID of the component to animate
     * @param int|null $duration Duration of the animation in milliseconds
     * @param string|null $easing Easing function for the animation
     * @param int|null $repeatCount Number of times to repeat the animation
     * @param RepeatMode|null $repeatMode How to repeat the animation
     * @param Value|null $value The property and values to animate
     */
    public function __construct(
        public ?string $componentId = null,
        public ?int $duration = null,
        public ?string $easing = null,
        public ?int $repeatCount = null,
        public ?RepeatMode $repeatMode = null,
        public ?Value $value = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->duration !== null) {
            $data['duration'] = $this->duration;
        }

        if ($this->easing !== null) {
            $data['easing'] = $this->easing;
        }

        if ($this->repeatCount !== null) {
            $data['repeatCount'] = $this->repeatCount;
        }

        if ($this->repeatMode !== null) {
            $data['repeatMode'] = $this->repeatMode->value;
        }

        if ($this->value !== null) {
            $data['value'] = $this->value;
        }

        return $data;
    }
}
