<?php

namespace App\Module\Message\Domain\Dto;

final class MessageFormDto
{
    public function __construct(
        public ?string $message = null,
    ) {}
}
