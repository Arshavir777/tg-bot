<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index()
    {
        $tgBotUsername = $_ENV['TG_BOT_USERNAME'];
        if (!$tgBotUsername) {
            throw new \Error('Please check TG_BOT_USERNAME env');
        }

        $tgBotLink = "https://t.me/$tgBotUsername";
        return $this->render('home.html.twig', [
            'tgBotLink' => $tgBotLink
        ]);
    }
}
