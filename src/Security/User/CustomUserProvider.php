<?php

namespace App\Security\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class CustomUserProvider implements UserProviderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByIdentifier(string $userId): UserInterface
    {
        return $this->fetchUser($userId);
    }


    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->fetchUser($user->getId());
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }

    private function fetchUser($userId): UserInterface
    {
        $user = $this->userRepository->findById($userId);

        if ($user) {
            return $user;
        }

        throw new \Error('User does not exist.');
    }
}
