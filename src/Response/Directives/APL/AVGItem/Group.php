<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\AVGItem;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AVGItemType;

class Group extends AVGItem implements \JsonSerializable
{
    public const TYPE = AVGItemType::GROUP;

    /**
     * @param string|null $clipPath Clipping path for the group
     * @param array|null $data Array of data for inflation
     * @param AVGItem|null $item Single child item
     * @param AVGItem[]|null $items Array of child items
     * @param float|null $opacity Opacity of the group
     * @param string|null $transform Transform to apply to the group
     */
    public function __construct(
        public ?string $clipPath = null,
        public ?array $data = null,
        public ?AVGItem $item = null,
        public ?array $items = null,
        public ?float $opacity = null,
        public ?string $transform = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->clipPath !== null) {
            $data['clipPath'] = $this->clipPath;
        }

        if (!empty($this->data)) {
            $data['data'] = $this->data;
        }

        if ($this->item !== null) {
            $data['item'] = $this->item;
        }

        if (!empty($this->items)) {
            $data['items'] = $this->items;
        }

        if ($this->opacity !== null) {
            $data['opacity'] = $this->opacity;
        }

        if ($this->transform !== null) {
            $data['transform'] = $this->transform;
        }

        return $data;
    }
}
