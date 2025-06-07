<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Application\Commands\CreateWorkEntry;

use App\Sesame\WorkEntry\Domain\Entities\WorkEntry;
use App\Sesame\WorkEntry\Domain\Repositories\WorkEntrySaveRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateWorkEntryHandler implements CommandHandler
{
    public function __construct(private WorkEntrySaveRepository $workEntryRepository)
    {
    }

    public function __invoke(CreateWorkEntryCommand $command): void
    {
        $workEntry = WorkEntry::start(
            id: $command->id,
            userId: $command->userId,
            startDate: $command->startDate,
            createdAt: $command->createdAt,
        );

        $this->workEntryRepository->save($workEntry);
    }
}
