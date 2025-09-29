<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;

class Template implements \JsonSerializable
{
    use SerializeValueMapper;

    public const BACK_BUTTON_MODE_HIDDEN = 'HIDDEN';
    public const BACK_BUTTON_MODE_VISIBLE = 'VISIBLE';

    public ?string $type;
    public ?string $token;
    public ?string $backButton;
    public ?Image $backgroundImage;
    public ?string $title;
    public ?TextContent $textContent;
    public ?Image $image;

    /** @var ListItem[] */
    public array $listItems = [];

    public function addListItem(ListItem $item): void
    {
        $this->listItems[] = $item;
    }

    public static function create($type, $token, $backButton = self::BACK_BUTTON_MODE_VISIBLE, $backgroundImage = null, $title = null, $textContent = null, $image = null, $listItems = []): self
    {
        $template = new self();

        $template->type = $type;
        $template->token = $token;
        $template->backButton = $backButton;
        $template->backgroundImage = $backgroundImage;
        $template->title = $title;
        $template->textContent = $textContent;
        $template->image = $image;
        $template->listItems = $listItems;

        return $template;
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
