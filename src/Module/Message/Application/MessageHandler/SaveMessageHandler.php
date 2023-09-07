<?php

namespace App\Module\Message\Application\MessageHandler;

use App\Module\Message\Application\Message\SaveMessageMessage;
use App\Module\Message\Domain\Dto\MessageIdDto;
use App\Module\Message\Infrastructure\Persistence\MessagePersistence;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class SaveMessageHandler
{
    public function __construct(
        protected MessagePersistence $messagePersistence
    ) {}

    public function __invoke(SaveMessageMessage $message): MessageIdDto
    {
        return $this->messagePersistence->saveForm($message->formDto)->toMessageIdDto();
    }
}
