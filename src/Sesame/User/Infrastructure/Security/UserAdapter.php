<?php

declare(strict_types=1);

namespace App\Sesame\User\Infrastructure\Security;

use App\Sesame\User\Domain\Entities\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final readonly class UserAdapter implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private User $user,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getRoles(): array
    {
        // In a real application, you might want to store roles in the User entity
        // For now, we'll just return a default role
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // Nothing to erase as we don't store sensitive data in this object
    }

    public function getUserIdentifier(): string
    {
        return $this->user->emailValue();
    }

    public function getPassword(): ?string
    {
        return $this->user->password()->value();
    }
}
