<?php

declare(strict_types=1);

namespace App\Sesame\User\Application\Commands\DeleteUser;

use App\Sesame\User\Domain\Exceptions\UserNotFoundException;
use App\Sesame\User\Domain\Repositories\UserFindRepository;
use App\Sesame\User\Domain\Repositories\UserSaveRepository;
use Ramsey\Uuid\Uuid;

final readonly class DeleteUserHandler
{
    public function __construct(
        private UserSaveRepository $userSaveRepository,
        private UserFindRepository $userFindRepository,
    ) {
    }

    public function __invoke(DeleteUserCommand $command): void
    {
        $userId = Uuid::fromString($command->id);
        $user   = $this->userFindRepository->findById($userId);

        if (null === $user) {
            throw UserNotFoundException::withId($userId);
        }

        $user->delete();
        $this->userSaveRepository->save($user);
    }
}
