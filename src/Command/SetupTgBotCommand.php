<?php

namespace App\Command;

use App\Service\TgBotService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(
    name: 'tg-bot:set-webhook',
    description: 'Set telegram bot webhook base url',
    hidden: false
)]
class SetupTgBotCommand extends Command
{
    private $tgBotService;

    public function __construct(TgBotService $tgBotService)
    {
        $this->tgBotService = $tgBotService;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('url', InputArgument::OPTIONAL, 'Telegram webhook url');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $url = $input->getArgument('url');

        if ($url && !filter_var($url, FILTER_VALIDATE_URL)) {
            die('Not a valid URL' . PHP_EOL);
        }
       
        $this->tgBotService->setWebhook($url);

        return Command::SUCCESS;
    }
}
