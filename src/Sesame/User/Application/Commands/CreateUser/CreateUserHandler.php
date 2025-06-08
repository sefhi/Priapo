<?php

declare(strict_types=1);

namespace App\Sesame\User\Application\Commands\CreateUser;

use App\Sesame\User\Domain\Entities\User;
use App\Sesame\User\Domain\Repositories\UserSaveRepository;
use App\Sesame\User\Infrastructure\Security\UserAdapter;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class CreateUserHandler implements CommandHandler
{
    public function __construct(
        private UserSaveRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {

        $user = User::create(
            $command->id,
            $command->name,
            $command->email,
            $command->plainPassword,
            $command->createdAt,
        );

        $userAdapter = new UserAdapter($user);

        $hashedPassword = $this->passwordHasher->hashPassword($userAdapter, $command->plainPassword);

        $this->userRepository->save($user->withPasswordHashed($hashedPassword));
    }
}
