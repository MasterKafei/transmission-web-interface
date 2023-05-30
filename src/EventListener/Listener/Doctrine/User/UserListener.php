<?php

namespace App\EventListener\Listener\Doctrine\User;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
    ) {}

    public function prePersist(User $user): void
    {
       $hashedPassword = $this->hasher->hashPassword($user, $user->getPlainPassword());
       $user->setPassword($hashedPassword);
    }
}
