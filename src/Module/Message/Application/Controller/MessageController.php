<?php

namespace App\Module\Message\Application\Controller;

use App\Module\Message\Application\Form\MessageSortFormType;
use App\Module\Message\Infrastructure\Query\FindMessageQuery;
use App\Module\Message\Infrastructure\Query\GetAllMessagesQuery;
use App\Module\Message\Infrastructure\Query\SortMessagesQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class MessageController extends AbstractController
{
    public function list(
        Request $request,
        GetAllMessagesQuery $getAllMessagesQuery,
        SortMessagesQuery $sortMessagesQuery
    ): JsonResponse
    {
        $messages = $getAllMessagesQuery->getAll();
        $form = $this->createForm(MessageSortFormType::class, options: ['method' => 'GET']);
        $form->submit($request->query->all('sort'), false);

        if ($form->isSubmitted() && $form->isValid()) {
            $messages = $sortMessagesQuery->sort($messages, $form->getData());
        }

        return $this->json($messages->toArray());
    }

    public function getMessage(Uuid $id, FindMessageQuery $findMessageQuery): JsonResponse
    {
        $message = $findMessageQuery->find($id);

        if (is_null($message)) {
            return $this->json('Not found message', Response::HTTP_NOT_FOUND);
        }

        return $this->json($message);
    }
}
