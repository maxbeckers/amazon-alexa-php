<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AlignItems;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Direction;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\JustifyContent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Wrap;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ContainerComponent extends MultiChildComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::CONTAINER;

    /**
     * @param AlignItems|null $alignItems Alignment for children in the cross-axis
     * @param Direction|null $direction Direction in which to display the child components
     * @param JustifyContent|null $justifyContent How to distribute free space when there is room on the main axis
     * @param bool $numbered When true, assign ordinal numbers to children
     * @param Wrap|null $wrap Determines how to wrap child components to multiple lines
     */
    public function __construct(
        public ?AlignItems $alignItems = null,
        public ?Direction $direction = null,
        public ?JustifyContent $justifyContent = null,
        public bool $numbered = false,
        public ?Wrap $wrap = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->alignItems !== null) {
            $data['alignItems'] = $this->alignItems->value;
        }

        if ($this->direction !== null) {
            $data['direction'] = $this->direction->value;
        }

        if ($this->justifyContent !== null) {
            $data['justifyContent'] = $this->justifyContent->value;
        }

        if ($this->numbered) {
            $data['numbered'] = $this->numbered;
        }

        if ($this->wrap !== null) {
            $data['wrap'] = $this->wrap->value;
        }

        return $data;
    }
}
