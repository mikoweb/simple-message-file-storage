<?php

namespace App\Module\Message\Domain\Dto;

final readonly class MessageFormDto
{
    public function __construct(
        public string $message,
    ) {}
}
