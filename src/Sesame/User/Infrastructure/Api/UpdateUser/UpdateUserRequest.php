<?php

declare(strict_types=1);

namespace App\Sesame\User\Infrastructure\Api\UpdateUser;

use App\Sesame\User\Application\Commands\UpdateUser\UpdateUserCommand;

final class UpdateUserRequest
{
    public function __construct(
        public string $name,
        public string $email,
        public string $createdAt,
        public string $updatedAt,
        public ?string $deletedAt = null,
    ) {
    }

    public function toUpdateUserCommand(string $id): UpdateUserCommand
    {
        return new UpdateUserCommand(
            $id,
            $this->name,
            $this->email,
            new \DateTimeImmutable($this->createdAt),
            new \DateTimeImmutable($this->updatedAt),
            $this->deletedAt
                ? new \DateTimeImmutable($this->deletedAt)
                : null,
        );
    }
}
