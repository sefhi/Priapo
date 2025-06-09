<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Infrastructure\Persistence\Repositories;

use App\Sesame\WorkEntry\Domain\Collections\WorkEntries;
use App\Sesame\WorkEntry\Domain\Entities\WorkEntry;
use App\Sesame\WorkEntry\Domain\Repositories\WorkEntryFindRepository;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Criteria\DoctrineCriteriaConverter;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

final readonly class DoctrineWorkEntryFindRepository extends DoctrineRepository implements WorkEntryFindRepository
{
    private array $criteriaToDoctrineFields;
    private array $hydrators;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->criteriaToDoctrineFields = [
            'id'        => 'id',
            'userId'    => 'userId',
            'createdAt' => 'timestamps.createdAt',
            'updatedAt' => 'timestamps.updateAt',
        ];
        $this->hydrators = [
            'createdAt' => \DateTimeImmutable::class,
            'updatedAt' => \DateTimeImmutable::class,
        ];
    }

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

    public function searchAllByCriteria(Criteria $criteria): WorkEntries
    {
        $workEntryRepository = $this->repository(WorkEntry::class);

        $doctrineCollection = $workEntryRepository->matching(
            DoctrineCriteriaConverter::convert(
                $criteria,
                $this->criteriaToDoctrineFields,
                $this->hydrators
            )
        );

        if ($doctrineCollection->isEmpty()) {
            return WorkEntries::empty();
        }

        return WorkEntries::fromArray($doctrineCollection->toArray());
    }
}
