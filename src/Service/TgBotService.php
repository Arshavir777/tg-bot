<?php

namespace App\Service;

use App\Api\TgBotApi;

class TgBotService
{
    private $tgBotApi;

    public function __construct(TgBotApi $tgBotApi)
    {
        $this->tgBotApi = $tgBotApi;
    }

    public function setWebhook(string $url)
    {
        $setResult = $this->tgBotApi->call(TgBotApi::METHOD_SET_WEBHOOK, [
            'url' => $url
        ]);
        $getResult = $this->tgBotApi->call(TgBotApi::METHOD_GET_WEBHOOK_INFO);
        return ['setResult' => $setResult, 'getResult' => $getResult];
    }

    public function sendMessage(string $text, $charId)
    {
        return $this->tgBotApi->call(TgBotApi::METHOD_SEND_MESSAGE, [
            'chat_id' => $charId,
            'disable_web_page_preview' => true, // set true to disable link preview or link unfurling
            'text' => $text
        ]);
    }
}
