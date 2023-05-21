<?php

namespace App\Controller;

use App\Repository\AuthLogRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;


class DashboardController extends AbstractController
{

    #[Route('/dashboard', name: 'dashboard.index', methods: ['GET'])]
    public function index()
    {
        return $this->render('dashboard.html.twig');
    }

    #[Route('/dashboard/auth-logs', name: 'dashboard.auth_logs', methods: ['GET'])]
    public function authLogs(AuthLogRepository $authLogRepository, UserInterface $user)
    {

        $logs = $authLogRepository->findByUserId($user->getId());

        return $this->render('logs.html.twig', [
            'logs' => $logs
        ]);
    }
}
