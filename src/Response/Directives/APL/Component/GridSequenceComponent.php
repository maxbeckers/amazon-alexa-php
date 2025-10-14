<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Request\ScrollDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Snap;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
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

        $this->includeIfNotNull($data, 'childHeight', $this->childHeight);
        $this->includeArrayIfNotEmpty($data, 'childHeights', $this->childHeights);
        $this->includeIfNotNull($data, 'childWidth', $this->childWidth);
        $this->includeArrayIfNotEmpty($data, 'childWidths', $this->childWidths);
        $this->includeBooleanTrue($data, 'numbered', $this->numbered);
        $this->includeArrayIfNotEmpty($data, 'onScroll', $this->onScroll);
        $this->includeArrayIfNotEmpty($data, 'preserve', $this->preserve);
        $this->includeEnum($data, 'scrollDirection', $this->scrollDirection);
        $this->includeEnum($data, 'snap', $this->snap);

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function includeIfNotNull(array &$data, string $key, mixed $value): void
    {
        if ($value !== null) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param array<mixed>|null $value
     */
    private function includeArrayIfNotEmpty(array &$data, string $key, ?array $value): void
    {
        if ($value !== null && $value !== []) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function includeBooleanTrue(array &$data, string $key, bool $value): void
    {
        if ($value) {
            $data[$key] = true;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function includeEnum(array &$data, string $key, ?\UnitEnum $enum): void
    {
        if ($enum !== null) {
            $data[$key] = $enum->value;
        }
    }
}
