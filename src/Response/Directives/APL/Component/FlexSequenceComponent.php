<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Request\ScrollDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\FlexAlignItems;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Snap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class FlexSequenceComponent extends APLBaseComponent implements \JsonSerializable
{
    use ActionableComponentTrait;
    use MultiChildComponentTrait;

    public const TYPE = APLComponentType::FLEX_SEQUENCE;

    /**
     * @param FlexAlignItems|null $alignItems Alignment for children in the cross-axis
     * @param bool $numbered When true, assign ordinal numbers to the FlexSequence children
     * @param AbstractStandardCommand[]|null $onScroll Commands to run when scrolling
     * @param ScrollDirection|null $scrollDirection The direction to scroll this FlexSequence
     * @param Snap|null $snap The alignment that the child components snap to when scrolling stops
     */
    public function __construct(
        public ?FlexAlignItems $alignItems = null,
        public bool $numbered = false,
        public ?array $onScroll = null,
        public ?ScrollDirection $scrollDirection = null,
        public ?Snap $snap = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = array_merge(
            parent::jsonSerialize(),
            $this->serializeActionableProperties(),
            $this->serializeMultiChildProperties()
        );

        if ($this->alignItems !== null) {
            $data['alignItems'] = $this->alignItems->value;
        }

        if ($this->numbered) {
            $data['numbered'] = $this->numbered;
        }

        if ($this->onScroll !== null && !empty($this->onScroll)) {
            $data['onScroll'] = $this->onScroll;
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
