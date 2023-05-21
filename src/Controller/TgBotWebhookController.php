<?php

namespace App\Controller;

use App\Service\SecurityService;
use App\Service\TgBotService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class TgBotWebhookController extends AbstractController
{
    private LoggerInterface $logger;
    private TgBotService $tgBotService;
    private SecurityService $securityService;

    public function __construct(
        LoggerInterface $logger,
        TgBotService $tgBotService,
        SecurityService $securityService
    ) {
        $this->logger = $logger;
        $this->tgBotService = $tgBotService;
        $this->securityService = $securityService;
    }

    #[Route('/ping', name: 'tg-bot.ping', methods: ['GET'])]
    public function ping()
    {
        return new Response('success');
    }

    #[Route('/set-webhook', name: 'tg-bot.set_webhook', methods: ['GET'])]
    public function setWebhook(Request $request, TgBotService $tgBotService)
    {
        $webhookUrl = $request->query->get('url');

        if ($webhookUrl && !filter_var($webhookUrl, FILTER_VALIDATE_URL)) {
            return new JsonResponse([
                'error' => 'Invalid URL'
            ]);
        }

        if (!$webhookUrl) {
            $host = $request->getHost();
            $webhookUrl = "https://$host/webhook";
        }

        $result = $tgBotService->setWebhook($webhookUrl);
        return new JsonResponse($result);
    }

    #[Route('/webhook', name: 'tg-bot.webhook', methods: ['POST'])]
    public function webhook(Request $request)
    {
        $this->logger->info($request->getContent());
        $data = json_decode($request->getContent());

        $message = $data->message->text;
        $chatId  = $data->message->chat->id;
        $userDto = $data->message->from;

        if ($message === '/start') {
            $loginLink = $this->securityService->auth($userDto);
            $this->tgBotService->sendMessage($loginLink, $chatId);
            return new JsonResponse(['authLink' => $loginLink]);
        }

        $this->tgBotService->sendMessage("Unrecognized action", $chatId);
        return new Response();
    }
}
