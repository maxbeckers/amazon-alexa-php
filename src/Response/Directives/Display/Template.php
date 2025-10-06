<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;

class Template implements \JsonSerializable
{
    use SerializeValueMapper;

    public const BACK_BUTTON_MODE_HIDDEN = 'HIDDEN';
    public const BACK_BUTTON_MODE_VISIBLE = 'VISIBLE';

    /** @var ListItem[] */
    public function __construct(
        public ?string $type = null,
        public ?string $token = null,
        public ?string $backButton = null,
        public ?Image $backgroundImage = null,
        public ?string $title = null,
        public ?TextContent $textContent = null,
        public ?Image $image = null,
        public array $listItems = []
    ) {
    }

    public function addListItem(ListItem $item): void
    {
        $this->listItems[] = $item;
    }

    public static function create($type, $token, $backButton = self::BACK_BUTTON_MODE_VISIBLE, $backgroundImage = null, $title = null, $textContent = null, $image = null, $listItems = []): self
    {
        return new self($type, $token, $backButton, $backgroundImage, $title, $textContent, $image, $listItems);
    }

    public function jsonSerialize(): \ArrayObject
    {
        $data = new \ArrayObject();

        $this->valueToArrayIfSet($data, 'type');
        $this->valueToArrayIfSet($data, 'token');
        $this->valueToArrayIfSet($data, 'backButton');
        $this->valueToArrayIfSet($data, 'backgroundImage');
        $this->valueToArrayIfSet($data, 'title');
        $this->valueToArrayIfSet($data, 'textContent');
        $this->valueToArrayIfSet($data, 'image');

        if (!empty($this->listItems)) {
            $data['listItems'] = $this->listItems;
        }

        return $data;
    }
}
