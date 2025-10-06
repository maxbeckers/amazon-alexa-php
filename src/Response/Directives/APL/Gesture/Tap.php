<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class Tap extends AbstractGesture
{
    /**
     * @param AbstractStandardCommand[]|null $onTap Commands to run when a tap occurs
     * @param AbstractStandardCommand[]|null $onCancel Commands to run when gesture is cancelled
     * @param bool|null $when APL boolean expression controlling whether this gesture is active
     */
    public function __construct(
        public ?array $onTap = null,
        ?array $onCancel = null,
        ?bool $when = null,
    ) {
        parent::__construct(GestureType::TAP, $onCancel, $when);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->onTap !== null && !empty($this->onTap)) {
            $data['onTap'] = $this->onTap;
        }

        return $data;
    }
}
