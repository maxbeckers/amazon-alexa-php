<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class ScrollViewComponent extends ActionableComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::SCROLL_VIEW;

    /**
     * @param APLBaseComponent|null $item Single component displayed in the ScrollView
     * @param APLBaseComponent[]|null $items Array of components displayed in the ScrollView
     * @param string[]|null $preserve Properties to save when reinflating the document
     * @param AbstractStandardCommand[]|null $onScroll Commands to run during scrolling
     */
    public function __construct(
        public ?APLBaseComponent $item = null,
        public ?array $items = null,
        ?array $preserve = null,
        public ?array $onScroll = null,
    ) {
        parent::__construct(type: self::TYPE, preserve: $preserve);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->item !== null) {
            $data['item'] = $this->item;
        }

        if ($this->items !== null && !empty($this->items)) {
            $data['items'] = $this->items;
        }

        if ($this->preserve !== null && !empty($this->preserve)) {
            $data['preserve'] = $this->preserve;
        }

        if ($this->onScroll !== null && !empty($this->onScroll)) {
            $data['onScroll'] = $this->onScroll;
        }

        return $data;
    }
}
