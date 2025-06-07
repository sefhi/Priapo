<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Application\Commands\UpdateWorkEntry;

use App\Shared\Domain\Bus\Command\Command;

/**
 * @see UpdateWorkEntryHandler
 */
final readonly class UpdateWorkEntryCommand implements Command
{
    public function __construct(
        public string $id,
        public string $userId,
        public \DateTimeImmutable $startDate,
        public \DateTimeImmutable $endDate,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $updatedAt,
        public ?\DateTimeImmutable $deletedAt = null,
    ) {
    }
}
