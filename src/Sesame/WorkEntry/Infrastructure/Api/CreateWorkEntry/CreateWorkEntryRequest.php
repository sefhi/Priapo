<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Infrastructure\Api\CreateWorkEntry;

use App\Sesame\WorkEntry\Application\Commands\CreateWorkEntry\CreateWorkEntryCommand;

final class CreateWorkEntryRequest
{
    public function __construct(
        public string $id,
        public string $userId,
        public string $startDate,
        public string $createdAt,
    ) {
    }

    public function toCreateWorkEntryCommand(): CreateWorkEntryCommand
    {
        return new CreateWorkEntryCommand(
            $this->id,
            $this->userId,
            new \DateTimeImmutable($this->startDate),
            new \DateTimeImmutable($this->createdAt),
        );
    }
}
