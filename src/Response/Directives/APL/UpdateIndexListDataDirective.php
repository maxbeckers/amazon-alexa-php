<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class UpdateIndexListDataDirective extends Directive implements \JsonSerializable
{
    public const TYPE = 'Alexa.Presentation.APL.UpdateIndexListData';

    /**
     * @param string $token The presentation token specified in the RenderDocument directive
     * @param string $listId The identifier for the list to update with this response
     * @param int $listVersion The new version of the list following the update
     * @param array $operations Individual operations to apply to the list, in array order
     */
    public function __construct(
        public string $token,
        public string $listId,
        public int $listVersion,
        public array $operations = [],
    ) {
        parent::__construct();
    }

    public function addOperation(array $operation): void
    {
        $this->operations[] = $operation;
    }

    public function addInsertItemOperation(int $index, array $item): void
    {
        $this->operations[] = [
            'type' => UpdateIndexListDataOperationType::INSERT_ITEM->value,
            'index' => $index,
            'item' => $item,
        ];
    }

    public function addInsertMultipleItemsOperation(int $index, array $items): void
    {
        $this->operations[] = [
            'type' => UpdateIndexListDataOperationType::INSERT_MULTIPLE_ITEMS->value,
            'index' => $index,
            'items' => $items,
        ];
    }

    public function addSetItemOperation(int $index, array $item): void
    {
        $this->operations[] = [
            'type' => UpdateIndexListDataOperationType::SET_ITEM->value,
            'index' => $index,
            'item' => $item,
        ];
    }

    public function addDeleteItemOperation(int $index): void
    {
        $this->operations[] = [
            'type' => UpdateIndexListDataOperationType::DELETE_ITEM->value,
            'index' => $index,
        ];
    }

    public function addDeleteMultipleItemsOperation(int $index, int $count): void
    {
        $this->operations[] = [
            'type' => UpdateIndexListDataOperationType::DELETE_MULTIPLE_ITEMS->value,
            'index' => $index,
            'count' => $count,
        ];
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => self::TYPE,
            'token' => $this->token,
            'listId' => $this->listId,
            'listVersion' => $this->listVersion,
            'operations' => $this->operations,
        ];
    }
}
