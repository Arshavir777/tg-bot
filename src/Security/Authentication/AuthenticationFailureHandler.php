<?php

namespace App\Security\Authentication;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class AuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{
    private RouterInterface $router;
    private LoggerInterface $logger;


    public function __construct(RouterInterface $router, LoggerInterface $logger)
    {
        $this->router = $router;
        $this->logger = $logger;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): RedirectResponse
    {

        $this->logger->error('error', (array)$exception);
        $request->getSession()->getFlashBag()->add('error', $exception->getMessage());

        $url = $this->router->generate('home.index');
        return new RedirectResponse($url);
    }
}
