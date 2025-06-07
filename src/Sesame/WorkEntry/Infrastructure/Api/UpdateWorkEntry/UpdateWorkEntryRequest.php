<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Infrastructure\Api\UpdateWorkEntry;

use App\Sesame\WorkEntry\Application\Commands\UpdateWorkEntry\UpdateWorkEntryCommand;

final class UpdateWorkEntryRequest
{
    public function __construct(
        public string $userId,
        public string $startDate,
        public string $endDate,
        public string $createdAt,
        public string $updatedAt,
        public ?string $deletedAt = null,
    ) {
    }

    public function toUpdateWorkEntryCommand(string $id): UpdateWorkEntryCommand
    {
        return new UpdateWorkEntryCommand(
            $id,
            $this->userId,
            new \DateTimeImmutable($this->startDate),
            new \DateTimeImmutable($this->endDate),
            new \DateTimeImmutable($this->createdAt),
            new \DateTimeImmutable($this->updatedAt),
            $this->deletedAt
                ? new \DateTimeImmutable($this->deletedAt)
                : null,
        );
    }
}
