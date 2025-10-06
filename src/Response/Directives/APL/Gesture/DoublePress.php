<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class DoublePress extends AbstractGesture
{
    /**
     * @param AbstractStandardCommand[]|null $onDoublePress Commands to run on double press
     * @param AbstractStandardCommand[]|null $onSinglePress Commands to run on single press
     * @param AbstractStandardCommand[]|null $onCancel Commands to run when gesture is cancelled
     * @param bool|null $when APL boolean expression controlling whether this gesture is active
     */
    public function __construct(
        public ?array $onDoublePress = null,
        public ?array $onSinglePress = null,
        ?array $onCancel = null,
        ?bool $when = null,
    ) {
        parent::__construct(GestureType::DOUBLE_PRESS, $onCancel, $when);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->onDoublePress !== null && !empty($this->onDoublePress)) {
            $data['onDoublePress'] = $this->onDoublePress;
        }

        if ($this->onSinglePress !== null && !empty($this->onSinglePress)) {
            $data['onSinglePress'] = $this->onSinglePress;
        }

        return $data;
    }
}
