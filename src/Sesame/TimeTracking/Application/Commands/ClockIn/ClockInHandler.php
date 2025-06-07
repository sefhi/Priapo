<?php

declare(strict_types=1);

namespace App\Sesame\TimeTracking\Application\Commands\ClockIn;

use App\Sesame\WorkEntry\Domain\Repositories\WorkEntrySaveRepository;
use App\Sesame\WorkEntry\Domain\Services\EnsureExistWorkEntryByIdService;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Ramsey\Uuid\Uuid;

final readonly class ClockInHandler implements CommandHandler
{
    public function __construct(
        private WorkEntrySaveRepository $workEntrySaveRepository,
        private EnsureExistWorkEntryByIdService $ensureExistsWorkEntryByIdService,
    ) {
    }

    public function __invoke(ClockInCommand $command): void
    {
        $workEntryId = Uuid::fromString($command->workEntryId);

        $workEntry = ($this->ensureExistsWorkEntryByIdService)($workEntryId);
        $workEntry->clockIn($command->startDate);

        $this->workEntrySaveRepository->save($workEntry);
    }
}
