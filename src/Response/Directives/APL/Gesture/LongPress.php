<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class LongPress extends AbstractGesture
{
    /**
     * @param AbstractStandardCommand[]|null $onLongPressStart Commands to run when long press starts
     * @param AbstractStandardCommand[]|null $onLongPressEnd Commands to run when long press ends
     * @param AbstractStandardCommand[]|null $onCancel Commands to run when gesture is cancelled
     * @param bool|null $when APL boolean expression controlling whether this gesture is active
     */
    public function __construct(
        public ?array $onLongPressStart = null,
        public ?array $onLongPressEnd = null,
        ?array $onCancel = null,
        ?bool $when = null,
    ) {
        parent::__construct(GestureType::LONG_PRESS, $onCancel, $when);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->onLongPressStart !== null && !empty($this->onLongPressStart)) {
            $data['onLongPressStart'] = $this->onLongPressStart;
        }

        if ($this->onLongPressEnd !== null && !empty($this->onLongPressEnd)) {
            $data['onLongPressEnd'] = $this->onLongPressEnd;
        }

        return $data;
    }
}
