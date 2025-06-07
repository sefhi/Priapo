<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Application\Commands\UpdateWorkEntry;

use App\Sesame\User\Domain\Services\EnsureExistsUserByIdService;
use App\Sesame\WorkEntry\Domain\Exceptions\WorkEntryNotFoundException;
use App\Sesame\WorkEntry\Domain\Repositories\WorkEntryFindRepository;
use App\Sesame\WorkEntry\Domain\Repositories\WorkEntrySaveRepository;
use Ramsey\Uuid\Uuid;

final readonly class UpdateWorkEntryHandler
{
    public function __construct(
        private WorkEntrySaveRepository $workEntrySaveRepository,
        private WorkEntryFindRepository $workEntryFindRepository,
        private EnsureExistsUserByIdService $ensureExistsUserByIdService,
    ) {
    }

    public function __invoke(UpdateWorkEntryCommand $command): void
    {
        $userId      = Uuid::fromString($command->userId);
        $workEntryId = Uuid::fromString($command->id);

        ($this->ensureExistsUserByIdService)($userId);

        $workEntry = $this->workEntryFindRepository->findById($workEntryId);

        if (null === $workEntry) {
            throw WorkEntryNotFoundException::withId($workEntryId);
        }

        $workEntry->update(
            $command->userId,
            $command->startDate,
            $command->endDate,
            $command->createdAt,
            $command->updatedAt,
            $command->deletedAt,
        );

        $this->workEntrySaveRepository->save($workEntry);
    }
}
