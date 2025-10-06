<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;

class Layout implements \JsonSerializable
{
    /**
     * @param Bind[]|null $bind Array of binding objects
     * @param string|null $description Optional description of this layout
     * @param APLBaseComponent|null $item Single component to display
     * @param APLBaseComponent[]|null $items Array of components to display
     * @param LayoutParameter[]|null $parameters Array of layout parameters
     */
    public function __construct(
        public ?array $bind = null,
        public ?string $description = null,
        public ?APLBaseComponent $item = null,
        public ?array $items = null,
        public ?array $parameters = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'bind' => $this->bind,
            'description' => $this->description,
            'item' => $this->item,
            'items' => $this->items,
            'parameters' => $this->parameters,
        ], fn ($value) => $value !== null);
    }
}
