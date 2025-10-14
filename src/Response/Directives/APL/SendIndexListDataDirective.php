<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class SendIndexListDataDirective extends Directive implements \JsonSerializable
{
    public const TYPE = 'Alexa.Presentation.APL.SendIndexListData';

    /**
     * @param string $listId The identifier for the list to update with this response
     * @param int $startIndex Index of the first element in the items array
     * @param string|null $correlationToken The correlation token supplied in the LoadIndexListData request
     * @param int|null $listVersion The new version number for the list following the update
     * @param string|null $minimumInclusiveIndex The index of the first item in the array
     * @param string|null $maximumExclusiveIndex The last valid index of the array plus one
     * @param array $items Array of objects to add to the list
     */
    public function __construct(
        public string $listId,
        public int $startIndex,
        public ?string $correlationToken = null,
        public ?int $listVersion = null,
        public ?string $minimumInclusiveIndex = null,
        public ?string $maximumExclusiveIndex = null,
        public array $items = [],
    ) {
        parent::__construct();
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
            'startIndex' => $this->startIndex,
        ];

        if ($this->correlationToken !== null) {
            $data['correlationToken'] = $this->correlationToken;
        }

        if ($this->listVersion !== null) {
            $data['listVersion'] = $this->listVersion;
        }

        if ($this->minimumInclusiveIndex !== null) {
            $data['minimumInclusiveIndex'] = $this->minimumInclusiveIndex;
        }

        if ($this->maximumExclusiveIndex !== null) {
            $data['maximumExclusiveIndex'] = $this->maximumExclusiveIndex;
        }

        if (!empty($this->items)) {
            $data['items'] = $this->items;
        }

        return $data;
    }
}
