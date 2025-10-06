<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\APLBaseComponent;

class MainTemplate implements \JsonSerializable
{
    /**
     * @param string[]|null $parameters Array of parameter names
     * @param APLBaseComponent|null $item Single component to display
     * @param APLBaseComponent[]|null $items Array of components to display
     */
    public function __construct(
        public ?array $parameters = null,
        public ?APLBaseComponent $item = null,
        public ?array $items = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'parameters' => $this->parameters,
            'item' => $this->item,
            'items' => $this->items,
        ], fn ($value) => $value !== null);
    }
}
