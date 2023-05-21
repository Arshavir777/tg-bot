<?php

namespace App\Service;

use App\Entity\AuthLog;
use App\Repository\{AuthLogRepository, UserRepository};
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;

class SecurityService
{
    private UserRepository $userRepository;
    private AuthLogRepository $authLogRepository;
    private LoginLinkHandlerInterface $loginLinkHandler;

    public function __construct(
        UserRepository $userRepository,
        AuthLogRepository $authLogRepository,
        LoginLinkHandlerInterface $loginLinkHandler,
    ) {
        $this->userRepository = $userRepository;
        $this->authLogRepository = $authLogRepository;
        $this->loginLinkHandler = $loginLinkHandler;
    }

    public function auth($userDto): string
    {
        $user = $this->userRepository->findUserByTgId($userDto->id);

        if (!$user) {
            $user = $this->userRepository->saveUser($userDto);
            $this->authLogRepository->saveAuthLog([
                'user_id' => $user->getId(),
                'action'  => AuthLog::ACTION_REGISTER
            ]);
        }

        return $this->generateLoginLink($user->getId());
    }

    public function generateLoginLink(string $id): string
    {
        $user = $this->userRepository->findById($id);

        // create a login link for $user this returns an instance
        $loginLinkDetails = $this->loginLinkHandler->createLoginLink($user);
        $loginLink = $loginLinkDetails->getUrl();

        return $loginLink;
    }
}
