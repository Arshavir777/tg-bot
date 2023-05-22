# Symfony Project | Telegram Bot

## Prerequisites

* docker
* docker-compose
* telegram-bot

## Getting Started

```
$ git clone https://github.com/Arshavir777/tg-bot.git
$ cd tg-bot
$ cp .env.dist .env (UPDATE TG_BOT_TOKEN AND TG_BOT_USERNAME)
$ docker-compose up -d
```

`After start the app, need set telegram bot webhook URL`

If app running in the https:
[https://domain/set-webhook](https://domain/set-webhook)

Otherwise you can use ngrok: `ngrok http 80`

[http://localhost/set-webhook?url=url-from-ngrok/webhook](http://localhost/set-webhook?url=url-from-ngrok/webhook)

After go to this url you will see the json response from telegram bot.


