<?php

namespace app\utils;

use app\repository\UserRepository;
use Nette;
use Nette\Security\SimpleIdentity;
use Nette\Security\Authenticator;
use Nette\Security\AuthenticationException;

class BasicAuth implements Authenticator
{
    /** @var UserRepository*/
    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function authenticate(string $username, string $password): SimpleIdentity
    {
        $user = $this->userRepository->verifyUser($username, $password);

        if (!$user) {
            throw new AuthenticationException('Invalid credentials.');
        }

        return new SimpleIdentity(
            $user->id,
            $user->rights,
            ['name' => $user->name, 'email' => $user->email]
        );
    }
}