<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGFilter\AVGFilter;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;

abstract class AVGItem implements \JsonSerializable
{
    /**
     * @param AVGItemType $type Type of the AVG item
     * @param array|null $bind Array of binding objects
     * @param string|null $description Description of this item
     * @param AVGFilter|null $filter Single filter to apply
     * @param AVGFilter[]|null $filters Array of filters to apply
     * @param string|null $style Style to apply
     * @param bool|null $when Condition for rendering this item
     */
    public function __construct(
        public AVGItemType $type,
        public ?array $bind = null,
        public ?string $description = null,
        public ?AVGFilter $filter = null,
        public ?array $filters = null,
        public ?string $style = null,
        public ?bool $when = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->type->value,
        ];

        if (!empty($this->bind)) {
            $data['bind'] = $this->bind;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->filter !== null) {
            $data['filter'] = $this->filter;
        }

        if (!empty($this->filters)) {
            $data['filters'] = $this->filters;
        }

        if ($this->style !== null) {
            $data['style'] = $this->style;
        }

        if ($this->when !== null) {
            $data['when'] = $this->when;
        }

        return $data;
    }
}
