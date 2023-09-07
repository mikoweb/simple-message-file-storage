<?php

namespace App\Module\Message\Application\Message;

use App\Module\Message\Domain\Dto\MessageFormDto;

final readonly class SaveMessageMessage
{
    public function __construct(
        public MessageFormDto $formDto
    ) {}
}
