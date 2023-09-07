<?php

namespace App\Module\Message\Infrastructure\Query;

use App\Module\Message\Domain\Dto\MessageDto;
use App\Module\Message\Infrastructure\Path\MessageDatasetPath;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Uuid;

final readonly class FindMessageQuery
{
    public function __construct(
        private MessageDatasetPath $messageDatasetPath,
        private SerializerInterface $serializer
    ) {}

    public function find(Uuid $id): ?MessageDto
    {
        $fs = new Filesystem();
        $filePath = $this->messageDatasetPath->getFilePath($id);

        if (!$fs->exists($filePath)) {
            return null;
        }

        return $this->serializer->deserialize(file_get_contents($filePath), MessageDto::class, 'xml');
    }
}
