<?php

declare(strict_types=1);

namespace App\Sesame\User\Infrastructure\Api\CreateUser;

use App\Sesame\User\Application\Commands\CreateUser\CreateUserCommand;

final class CreateUserRequest
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        #[\SensitiveParameter] public string $plainPassword,
        public string $createdAt,
    ) {
    }

    public function toCreateUserCommand(): CreateUserCommand
    {
        return new CreateUserCommand(
            $this->id,
            $this->name,
            $this->email,
            $this->plainPassword,
            new \DateTimeImmutable($this->createdAt),
        );
    }
}
