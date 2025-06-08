<?php

declare(strict_types=1);

namespace App\Sesame\User\Application\Commands\CreateUser;

use App\Sesame\User\Domain\Entities\User;
use App\Sesame\User\Domain\Repositories\UserSaveRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateUserHandler implements CommandHandler
{
    public function __construct(
        private UserSaveRepository $userRepository,
        // TODO service password hasher
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

        $this->userRepository->save($user);
    }
}
