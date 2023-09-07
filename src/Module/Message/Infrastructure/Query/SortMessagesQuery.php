<?php

namespace App\Module\Message\Infrastructure\Query;

use App\Module\Message\Domain\Dto\List\MessageList;
use App\Module\Message\Domain\Dto\Sort\MessageSortDto;
use Ramsey\Collection\Sort;

final readonly class SortMessagesQuery
{
    public function sort(MessageList $list, MessageSortDto $sortDto): MessageList
    {
        if (is_null($sortDto->sortOption)) {
            return $list;
        }

        /** @var MessageList $sorted */
        $sorted = $list->sort($sortDto->sortOption->toCamelCase(), Sort::from($sortDto->sortDirection->value));

        return $sorted;
    }
}
