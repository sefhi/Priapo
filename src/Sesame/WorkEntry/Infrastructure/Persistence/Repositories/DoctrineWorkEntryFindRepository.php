<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Infrastructure\Persistence\Repositories;

use App\Sesame\WorkEntry\Domain\Entities\WorkEntry;
use App\Sesame\WorkEntry\Domain\Repositories\WorkEntryFindRepository;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;
use Ramsey\Uuid\UuidInterface;

final readonly class DoctrineWorkEntryFindRepository extends DoctrineRepository implements WorkEntryFindRepository
{
    public function findById(UuidInterface $id): ?WorkEntry
    {
        $result = $this->repository(WorkEntry::class)->findOneBy(
            [
                'id'                   => $id,
                'timestamps.deletedAt' => null,
            ]
        );

        return $result instanceof WorkEntry
            ? $result
            : null;
    }
}
