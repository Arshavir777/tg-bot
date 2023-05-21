<?php

namespace App\Security\Authentication;

use App\Entity\AuthLog;
use App\Repository\AuthLogRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private AuthLogRepository $authLogRepository;
    private RouterInterface $router;

    public function __construct(AuthLogRepository $authLogRepository, RouterInterface $router) {
        $this->authLogRepository = $authLogRepository;
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $user = $token->getUser();
        $this->authLogRepository->saveAuthLog([
            'user_id' => $user->getId(),
            'action'  => AuthLog::ACTION_LOGIN
        ]);

        return new RedirectResponse($this->router->generate('dashboard.index'));
    }
}