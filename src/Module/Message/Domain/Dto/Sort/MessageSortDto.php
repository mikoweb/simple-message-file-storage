<?php

namespace App\Module\Message\Domain\Dto\Sort;

use App\Module\Message\Domain\Enum\SortDirectionEnum;

final readonly class MessageSortDto
{
    public function __construct(
        public MessageSortOptionEnum $sortOption,
        public SortDirectionEnum $sortDirection,
    ) {}
}
