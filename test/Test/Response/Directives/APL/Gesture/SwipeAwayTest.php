<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Gesture;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\GestureType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SwipeAction;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\SwipeDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Gesture\SwipeAway;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use PHPUnit\Framework\TestCase;

class SwipeAwayTest extends TestCase
{
    public function testConstructorWithAllParameters(): void
    {
        $direction = SwipeDirection::LEFT;
        $action = SwipeAction::COVER;
        $item = $this->createMock(APLBaseComponent::class);
        $items = [$this->createMock(APLBaseComponent::class)];
        $onSwipeMove = [$this->createMock(AbstractStandardCommand::class)];
        $onSwipeDone = [$this->createMock(AbstractStandardCommand::class)];
        $onCancel = [$this->createMock(AbstractStandardCommand::class)];
        $when = true;

        $gesture = new SwipeAway($direction, $action, $item, $items, $onSwipeMove, $onSwipeDone, $onCancel, $when);

        $this->assertSame($direction, $gesture->direction);
        $this->assertSame($action, $gesture->action);
        $this->assertSame($item, $gesture->item);
        $this->assertSame($items, $gesture->items);
        $this->assertSame($onSwipeMove, $gesture->onSwipeMove);
        $this->assertSame($onSwipeDone, $gesture->onSwipeDone);
    }

    public function testConstructorWithDefaultParameters(): void
    {
        $gesture = new SwipeAway();

        $this->assertNull($gesture->direction);
        $this->assertNull($gesture->action);
        $this->assertNull($gesture->item);
        $this->assertNull($gesture->items);
        $this->assertNull($gesture->onSwipeMove);
        $this->assertNull($gesture->onSwipeDone);
    }

    public function testJsonSerializeWithAllProperties(): void
    {
        $direction = SwipeDirection::RIGHT;
        $action = SwipeAction::REVEAL;
        $item = $this->createMock(APLBaseComponent::class);
        $items = [$this->createMock(APLBaseComponent::class)];
        $onSwipeMove = [$this->createMock(AbstractStandardCommand::class)];
        $onSwipeDone = [$this->createMock(AbstractStandardCommand::class)];

        $gesture = new SwipeAway($direction, $action, $item, $items, $onSwipeMove, $onSwipeDone);
        $result = $gesture->jsonSerialize();

        $this->assertSame(GestureType::SWIPE_AWAY->value, $result['type']);
        $this->assertSame($direction->value, $result['direction']);
        $this->assertSame($action->value, $result['action']);
        $this->assertSame($item, $result['item']);
        $this->assertSame($items, $result['items']);
        $this->assertSame($onSwipeMove, $result['onSwipeMove']);
        $this->assertSame($onSwipeDone, $result['onSwipeDone']);
    }

    public function testJsonSerializeWithEmptyArrays(): void
    {
        $gesture = new SwipeAway(null, null, null, [], [], []);
        $result = $gesture->jsonSerialize();

        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('onSwipeMove', $result);
        $this->assertArrayNotHasKey('onSwipeDone', $result);
    }

    public function testJsonSerializeWithNullValues(): void
    {
        $gesture = new SwipeAway();
        $result = $gesture->jsonSerialize();

        $this->assertSame(GestureType::SWIPE_AWAY->value, $result['type']);
        $this->assertArrayNotHasKey('direction', $result);
        $this->assertArrayNotHasKey('action', $result);
        $this->assertArrayNotHasKey('item', $result);
        $this->assertArrayNotHasKey('items', $result);
        $this->assertArrayNotHasKey('onSwipeMove', $result);
        $this->assertArrayNotHasKey('onSwipeDone', $result);
    }
}
