<?php

namespace App\Module\Message\Domain\Dto;

use Symfony\Component\Uid\Uuid;

final readonly class MessageIdDto
{
    public function __construct(
        public Uuid $id,
    ) {}
}
