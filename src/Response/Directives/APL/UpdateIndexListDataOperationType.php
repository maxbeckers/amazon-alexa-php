<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL;

enum UpdateIndexListDataOperationType: string
{
    case INSERT_ITEM = 'InsertItem';
    case INSERT_MULTIPLE_ITEMS = 'InsertMultipleItems';
    case SET_ITEM = 'SetItem';
    case DELETE_ITEM = 'DeleteItem';
    case DELETE_MULTIPLE_ITEMS = 'DeleteMultipleItems';
}
