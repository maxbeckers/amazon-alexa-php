<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class SendTokenListDataDirective extends Directive implements \JsonSerializable
{
    public const TYPE = 'Alexa.Presentation.APL.SendTokenListData';

    /**
     * @param string $listId The identifier of the list whose items are contained in this response
     * @param string $pageToken Opaque token for the array of items which are contained in this response
     * @param string|null $correlationToken The correlation token supplied in the LoadTokenListData request
     * @param string|null $nextPageToken Opaque token to retrieve the next page of list items data
     * @param array $items Array of objects to be added to the list
     */
    public function __construct(
        public string $listId,
        public string $pageToken,
        public ?string $correlationToken = null,
        public ?string $nextPageToken = null,
        public array $items = [],
    ) {
    }

    public function addItem(array $item): void
    {
        $this->items[] = $item;
    }

    public function jsonSerialize(): array
    {
        $data = [
            'type' => self::TYPE,
            'listId' => $this->listId,
            'pageToken' => $this->pageToken,
        ];

        if ($this->correlationToken !== null) {
            $data['correlationToken'] = $this->correlationToken;
        }

        if ($this->nextPageToken !== null) {
            $data['nextPageToken'] = $this->nextPageToken;
        }

        if (!empty($this->items)) {
            $data['items'] = $this->items;
        }

        return $data;
    }
}
