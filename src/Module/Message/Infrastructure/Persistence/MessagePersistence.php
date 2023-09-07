<?php

namespace App\Module\Message\Infrastructure\Persistence;

use App\Module\Message\Domain\Dto\MessageDto;
use App\Module\Message\Domain\Dto\MessageFormDto;
use App\Module\Message\Infrastructure\Path\MessageDatasetPath;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Factory\UuidFactory;
use DateTime;

final readonly class MessagePersistence
{
    public function __construct(
        private MessageDatasetPath $messageDatasetPath,
        private UuidFactory $uuidFactory,
        private SerializerInterface $serializer
    ) {}

    public function saveForm(MessageFormDto $formDto): MessageDto
    {
        $message = new MessageDto(
            id: $this->uuidFactory->create(),
            message: $formDto->message,
            createdAt: new DateTime(),
        );

        $this->messageDatasetPath->initDirectoryPath();
        $filePath = $this->messageDatasetPath->getFilePath($message->id);

        file_put_contents($filePath, $this->serializer->serialize($message, 'xml'));

        return $message;
    }
}
