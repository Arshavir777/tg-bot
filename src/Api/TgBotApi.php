<?php

namespace App\Api;

class TgBotApi
{
    const METHOD_GET_ME = 'getMe';
    const METHOD_SET_WEBHOOK = 'setWebhook';
    const METHOD_GET_WEBHOOK_INFO = 'getWebhookInfo';
    const METHOD_SEND_MESSAGE = 'sendMessage';

    private $apiBaseUrl;
    private $token;

    public function __construct(string $token)
    {
        $this->apiBaseUrl = "https://api.telegram.org/bot";
        $this->token = $token;
    }

    public function call(string $method, array $params = [])
    {
        $url = $this->apiBaseUrl . $this->token . '/' . $method;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
