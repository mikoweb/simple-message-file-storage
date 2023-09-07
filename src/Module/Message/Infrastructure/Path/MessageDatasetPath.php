<?php

namespace App\Module\Message\Infrastructure\Path;

use App\Module\Core\Application\Path\AppPathResolver;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Uid\Uuid;
use SplFileInfo;

final readonly class MessageDatasetPath
{
    public function __construct(
        private AppPathResolver $appPathResolver,
    ) {}

    public function getDirectoryPath(): string
    {
        return $this->appPathResolver->getDatasetPath('messages');
    }

    public function initDirectoryPath(): void
    {
        $path = $this->getDirectoryPath();
        $fs = new Filesystem();

        if (!$fs->exists($path)) {
            $fs->mkdir($path);
        }
    }

    public function getFilePath(Uuid $id): string
    {
        $directoryPath = $this->getDirectoryPath();

        return "$directoryPath/$id.xml";
    }

    public function getIdFromFile(SplFileInfo $file): Uuid
    {
        $name = $file->getBasename('.' . $file->getExtension());

        return Uuid::fromString($name);
    }
}
