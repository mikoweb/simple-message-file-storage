<?php

namespace App\Module\Message\Domain\Dto\Sort;

enum MessageSortOptionEnum: string
{
    case ID = 'id';
    case CREATED_AD = 'created_at';
}
