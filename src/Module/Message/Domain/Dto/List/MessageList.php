<?php

namespace App\Module\Message\Domain\Dto\List;

use App\Module\Message\Domain\Dto\MessageDto;
use Ramsey\Collection\AbstractCollection;

final class MessageList extends AbstractCollection
{
    public function getType(): string
    {
        return MessageDto::class;
    }
}
