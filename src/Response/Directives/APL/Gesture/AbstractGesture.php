<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

abstract class AbstractGesture implements \JsonSerializable
{
    /**
     * @param GestureType $type The type of gesture
     * @param AbstractStandardCommand[]|null $onCancel Commands to run when gesture is cancelled
     * @param bool|null $when APL boolean expression controlling whether this gesture is active
     */
    public function __construct(
        public GestureType $type,
        public ?array $onCancel = null,
        public ?bool $when = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->type->value,
        ];

        if ($this->onCancel !== null && !empty($this->onCancel)) {
            $data['onCancel'] = $this->onCancel;
        }

        if ($this->when !== null) {
            $data['when'] = $this->when;
        }

        return $data;
    }
}
