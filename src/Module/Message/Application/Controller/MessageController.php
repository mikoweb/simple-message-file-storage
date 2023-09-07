<?php

namespace App\Module\Message\Application\Controller;

use App\Module\Message\Application\Form\MessageSortFormType;
use App\Module\Message\Infrastructure\Query\GetAllMessagesQuery;
use App\Module\Message\Infrastructure\Query\SortMessagesQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
}
