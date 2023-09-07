<?php

namespace App\Module\Message\Domain\Dto\Sort;

use function Symfony\Component\String\u;

enum MessageSortOptionEnum: string
{
    case ID = 'id';
    case CREATED_AT = 'created_at';

    public function toCamelCase(): string
    {
        return u($this->value)->camel()->toString();
    }
}
