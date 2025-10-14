<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SwipeAction;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SwipeDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class SwipeAway extends AbstractGesture
{
    /**
     * @param SwipeDirection|null $direction Direction the user swipes to activate the gesture
     * @param SwipeAction|null $action How to display the original and child components during the swipe gesture
     * @param APLBaseComponent|null $item Single item to display during and after the swipe gesture
     * @param APLBaseComponent[]|null $items Array of items to display during and after the swipe gesture
     * @param AbstractStandardCommand[]|null $onSwipeMove Commands to run as the swipe position changes
     * @param AbstractStandardCommand[]|null $onSwipeDone Commands to run when the swipe is complete
     * @param AbstractStandardCommand[]|null $onCancel Commands to run when gesture is cancelled
     * @param bool|null $when APL boolean expression controlling whether this gesture is active
     */
    public function __construct(
        public ?SwipeDirection $direction = null,
        public ?SwipeAction $action = null,
        public ?APLBaseComponent $item = null,
        public ?array $items = null,
        public ?array $onSwipeMove = null,
        public ?array $onSwipeDone = null,
        ?array $onCancel = null,
        ?bool $when = null,
    ) {
        parent::__construct(GestureType::SWIPE_AWAY, $onCancel, $when);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->direction !== null) {
            $data['direction'] = $this->direction->value;
        }

        if ($this->action !== null) {
            $data['action'] = $this->action->value;
        }

        if ($this->item !== null) {
            $data['item'] = $this->item;
        }

        if ($this->items !== null && !empty($this->items)) {
            $data['items'] = $this->items;
        }

        if ($this->onSwipeMove !== null && !empty($this->onSwipeMove)) {
            $data['onSwipeMove'] = $this->onSwipeMove;
        }

        if ($this->onSwipeDone !== null && !empty($this->onSwipeDone)) {
            $data['onSwipeDone'] = $this->onSwipeDone;
        }

        return $data;
    }
}
