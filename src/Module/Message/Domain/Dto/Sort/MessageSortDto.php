<?php

namespace App\Module\Message\Domain\Dto\Sort;

use App\Module\Message\Domain\Enum\SortDirectionEnum;

final class MessageSortDto
{
    public function __construct(
        public ?MessageSortOptionEnum $sortOption = null,
        public SortDirectionEnum $sortDirection = SortDirectionEnum::ASC,
    ) {}
}
