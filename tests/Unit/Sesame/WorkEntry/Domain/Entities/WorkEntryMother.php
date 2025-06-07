<?php

declare(strict_types=1);

namespace Tests\Unit\Sesame\WorkEntry\Domain\Entities;

use App\Sesame\WorkEntry\Application\Commands\CreateWorkEntry\CreateWorkEntryCommand;
use App\Sesame\WorkEntry\Application\Commands\UpdateWorkEntry\UpdateWorkEntryCommand;
use App\Sesame\WorkEntry\Domain\Entities\WorkEntry;
use Tests\Utils\Mother\MotherCreator;

final class WorkEntryMother
{
    public static function random(array $overrides = []): WorkEntry
    {
        $createdAt  = MotherCreator::dateTime();
        $hourRandom = random_int(0, 23);
        $updatedAt  = $createdAt->modify("+{$hourRandom} hours");

        $randomData = [
            'id'        => MotherCreator::id(),
            'userId'    => MotherCreator::id(),
            'startDate' => $createdAt,
            'endDate'   => $createdAt->modify('+1 hour'),
            'createdAt' => $createdAt,
            'updatedAt' => $updatedAt,
        ];

        $finalData = array_merge($randomData, $overrides);

        return WorkEntry::make(
            id: $finalData['id'],
            userId: $finalData['userId'],
            startDate: $finalData['startDate'],
            createdAt: $finalData['createdAt'],
            endDate: $finalData['endDate'],
            updatedAt: $finalData['updatedAt'],
        );
    }

    public static function start(array $overrides = []): WorkEntry
    {
        $randomData = [
            'id'        => MotherCreator::id(),
            'userId'    => MotherCreator::id(),
            'startDate' => MotherCreator::dateTime(),
            'endDate'   => null,
            'createdAt' => MotherCreator::dateTime(),
            'updatedAt' => null,
        ];

        $finalData = array_merge($randomData, $overrides);

        return WorkEntry::start(
            id: $finalData['id'],
            userId: $finalData['userId'],
            startDate: $finalData['startDate'],
            createdAt: $finalData['createdAt'],
        );
    }

    public static function fromCreateWorkEntryCommand(CreateWorkEntryCommand $command): WorkEntry
    {
        return WorkEntry::start(
            id: $command->id,
            userId: $command->userId,
            startDate: $command->startDate,
            createdAt: $command->createdAt,
        );
    }

    public static function fromUpdateWorkEntryCommand(UpdateWorkEntryCommand $command): WorkEntry
    {
        return WorkEntry::make(
            id: $command->id,
            userId: $command->userId,
            startDate: $command->startDate,
            createdAt: $command->createdAt,
            endDate: $command->endDate,
            updatedAt: $command->updatedAt,
        );
    }
}
