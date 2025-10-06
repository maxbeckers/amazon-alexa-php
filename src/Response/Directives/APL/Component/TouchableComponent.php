<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture\AbstractGesture;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

abstract class TouchableComponent extends ActionableComponent implements \JsonSerializable
{
    /**
     * @param APLComponentType $type The type of the component
     * @param AbstractGesture|null $gesture Single gesture handler
     * @param AbstractGesture[]|null $gestures Array of gesture handlers
     * @param AbstractStandardCommand[]|null $onCancel Commands to run when a gesture takes over the pointer
     * @param AbstractStandardCommand[]|null $onDown Commands to run when a pointer down event occurs
     * @param AbstractStandardCommand[]|null $onMove Commands to run as the pointer moves
     * @param AbstractStandardCommand[]|null $onPress Commands to run for a pointer down followed by a pointer up
     * @param AbstractStandardCommand[]|null $onUp Commands to run when releasing the pointer
     */
    public function __construct(
        APLComponentType $type,
        public ?AbstractGesture $gesture = null,
        public ?array $gestures = null,
        public ?array $onCancel = null,
        public ?array $onDown = null,
        public ?array $onMove = null,
        public ?array $onPress = null,
        public ?array $onUp = null,
    ) {
        parent::__construct($type);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->gesture !== null) {
            $data['gesture'] = $this->gesture;
        }

        if ($this->gestures !== null && !empty($this->gestures)) {
            $data['gestures'] = $this->gestures;
        }

        if ($this->onCancel !== null && !empty($this->onCancel)) {
            $data['onCancel'] = $this->onCancel;
        }

        if ($this->onDown !== null && !empty($this->onDown)) {
            $data['onDown'] = $this->onDown;
        }

        if ($this->onMove !== null && !empty($this->onMove)) {
            $data['onMove'] = $this->onMove;
        }

        if ($this->onPress !== null && !empty($this->onPress)) {
            $data['onPress'] = $this->onPress;
        }

        if ($this->onUp !== null && !empty($this->onUp)) {
            $data['onUp'] = $this->onUp;
        }

        return $data;
    }
}
