<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Domain\Repositories;

use App\Sesame\WorkEntry\Domain\Entities\WorkEntry;
use Ramsey\Uuid\UuidInterface;

interface WorkEntryFindRepository
{
    public function findById(UuidInterface $id): ?WorkEntry;
}
