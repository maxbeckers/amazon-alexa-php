<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;

class TouchWrapperComponent extends TouchableComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::TOUCH_WRAPPER;

    /**
     * @param APLBaseComponent|null $item Single child item to display
     * @param APLBaseComponent[]|null $items Array of child items to display
     */
    public function __construct(
        public ?APLBaseComponent $item = null,
        public ?array $items = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->item !== null) {
            $data['item'] = $this->item;
        }

        if (!empty($this->items)) {
            $data['items'] = $this->items;
        }

        return $data;
    }
}
