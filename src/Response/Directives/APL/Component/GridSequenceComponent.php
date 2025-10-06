<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Request\ScrollDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Snap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class GridSequenceComponent extends APLBaseComponent implements \JsonSerializable
{
    use ActionableComponentTrait;
    use MultiChildComponentTrait;

    public const TYPE = APLComponentType::GRID_SEQUENCE;

    /**
     * @param string|null $childHeight The height of children
     * @param string[]|null $childHeights Array of height dimensions for children
     * @param string|null $childWidth The width of children
     * @param string[]|null $childWidths Array of width dimensions for children
     * @param bool $numbered When true, assign ordinal numbers to the GridSequence children
     * @param AbstractStandardCommand[]|null $onScroll Commands to run during scrolling
     * @param string[]|null $preserve Properties to save when reinflating the document
     * @param ScrollDirection|null $scrollDirection The direction to scroll this GridSequence
     * @param Snap|null $snap The alignment that the child components snap to when scrolling stops
     */
    public function __construct(
        public ?string $childHeight = null,
        public ?array $childHeights = null,
        public ?string $childWidth = null,
        public ?array $childWidths = null,
        public bool $numbered = false,
        public ?array $onScroll = null,
        ?array $preserve = null,
        public ?ScrollDirection $scrollDirection = null,
        public ?Snap $snap = null,
    ) {
        parent::__construct(type: self::TYPE, preserve: $preserve);
    }

    public function jsonSerialize(): array
    {
        $data = array_merge(
            parent::jsonSerialize(),
            $this->serializeActionableProperties(),
            $this->serializeMultiChildProperties()
        );

        if ($this->childHeight !== null) {
            $data['childHeight'] = $this->childHeight;
        }

        if (!empty($this->childHeights)) {
            $data['childHeights'] = $this->childHeights;
        }

        if ($this->childWidth !== null) {
            $data['childWidth'] = $this->childWidth;
        }

        if (!empty($this->childWidths)) {
            $data['childWidths'] = $this->childWidths;
        }

        if ($this->numbered) {
            $data['numbered'] = $this->numbered;
        }

        if (!empty($this->onScroll)) {
            $data['onScroll'] = $this->onScroll;
        }

        if (!empty($this->preserve)) {
            $data['preserve'] = $this->preserve;
        }

        if ($this->scrollDirection !== null) {
            $data['scrollDirection'] = $this->scrollDirection->value;
        }

        if ($this->snap !== null) {
            $data['snap'] = $this->snap->value;
        }

        return $data;
    }
}
