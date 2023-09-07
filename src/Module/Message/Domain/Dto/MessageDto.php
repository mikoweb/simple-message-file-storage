<?php

namespace App\Module\Message\Domain\Dto;

use Symfony\Component\Uid\Uuid;
use DateTime;

final readonly class MessageDto
{
    public function __construct(
        public Uuid $id,
        public string $message,
        public DateTime $createdAt,
    ) {}

    public function toMessageIdDto(): MessageIdDto
    {
        return new MessageIdDto($this->id);
    }
}
