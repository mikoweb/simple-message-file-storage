<?php

namespace App\Module\Message\Infrastructure\Query;

use App\Module\Message\Domain\Dto\List\MessageList;
use App\Module\Message\Infrastructure\Path\MessageDatasetPath;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;
use Symfony\Component\Finder\Finder;

final readonly class GetAllMessagesQuery
{
    public function __construct(
        private MessageDatasetPath $messageDatasetPath,
        private FindMessageQuery $findMessageQuery
    ) {}

    public function getAll(): MessageList
    {
        $list = new MessageList();
        $finder = new Finder();

        try {
            $files = $finder->files()->in($this->messageDatasetPath->getDirectoryPath())->name('*.xml');
        } catch (DirectoryNotFoundException $exception) {
            return $list;
        }

        foreach ($files as $file) {
            $list->add($this->findMessageQuery->find($this->messageDatasetPath->getIdFromFile($file)));
        }

        return $list;
    }
}
