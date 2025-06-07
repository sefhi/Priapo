<?php

declare(strict_types=1);

namespace App\Sesame\User\Application\Queries\FindUserById;

use App\Sesame\User\Domain\Exceptions\UserNotFoundException;
use App\Sesame\User\Domain\Repositories\UserFindRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Ramsey\Uuid\Uuid;

final class FindUserByIdHandler implements CommandHandler
{
    public function __construct(
        private UserFindRepository $userFindRepository,
    ) {
    }

    public function __invoke(FindUserByIdQuery $query): UserResponse
    {
        $userId = Uuid::fromString($query->id);
        $user   = $this->userFindRepository->findById($userId);

        if (null === $user) {
            throw UserNotFoundException::withId($userId);
        }

        return UserResponse::fromUser($user);
    }
}
