<?php

namespace App\Module\Message\Application\Controller;

use App\Module\Message\Application\Form\MessageFormType;
use App\Module\Message\Application\Form\MessageSortFormType;
use App\Module\Message\Infrastructure\Persistence\MessagePersistence;
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
        $form = $this->createForm(MessageSortFormType::class);
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

    public function create(Request $request, MessagePersistence $messagePersistence): JsonResponse
    {
        $formData = json_decode($request->getContent(), true) ?? [];
        $form = $this->createForm(MessageFormType::class);
        $form->submit($formData);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $messagePersistence->saveForm($form->getData())->toMessageIdDto();
        } else {
            return $this->json(['Invalid form data'], Response::HTTP_BAD_REQUEST);
        }

        return $this->json($id);
    }
}
