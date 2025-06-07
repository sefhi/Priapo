<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Application\Queries;

use App\Sesame\WorkEntry\Domain\Entities\WorkEntry;
use App\Shared\Domain\Bus\Query\QueryResponse;

final readonly class WorkEntryResponse implements QueryResponse
{
    public function __construct(
        public string $id,
        public string $userId,
        public \DateTimeImmutable $startDate,
        public ?\DateTimeImmutable $endDate,
        public \DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
    ) {
    }

    public static function fromWorkEntry(WorkEntry $workEntry): self
    {
        return new self(
            $workEntry->id()->toString(),
            $workEntry->userId()->toString(),
            $workEntry->startDate(),
            $workEntry->endDate(),
            $workEntry->createdAt(),
            $workEntry->updatedAt(),
        );
    }
}
