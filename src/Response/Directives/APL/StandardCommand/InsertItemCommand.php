<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

class InsertItemCommand extends AbstractStandardCommand
{
    public const TYPE = 'InsertItem';

    /**
     * @param int|null $at Index where to insert the item
     * @param string|null $componentId The ID of the component to insert into
     * @param mixed $item Single item/component to insert (can be array, object, or APL component)
     * @param array|null $items Array of items/components to insert
     */
    public function __construct(
        public ?int $at = null,
        public ?string $componentId = null,
        public mixed $item = null,
        public ?array $items = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->at !== null) {
            $data['at'] = $this->at;
        }

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->item !== null) {
            $data['item'] = $this->item;
        }

        if ($this->items !== null && !empty($this->items)) {
            $data['items'] = $this->items;
        }

        return $data;
    }
}
