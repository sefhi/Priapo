<?php

declare(strict_types=1);

namespace App\Sesame\User\Application\Commands\DeleteUser;

final readonly class DeleteUserCommand
{
    public function __construct(
        public string $id,
    ) {
    }
}
