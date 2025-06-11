<?php

declare(strict_types=1);

namespace App\Sesame\TimeTracking\Infrastructure\Api\ClockOut;

use App\Sesame\TimeTracking\Application\Commands\ClockOut\ClockOutCommand;

final class ClockOutRequest
{
    public function __construct(
        public ?string $endDate = null,
    ) {
    }

    public function toClockOutCommand(
        string $workEntryId,
        string $userId,
    ): ClockOutCommand {
        return new ClockOutCommand(
            $workEntryId,
            $userId,
            $this->endDate
                ? new \DateTimeImmutable($this->endDate)
                : new \DateTimeImmutable(),
        );
    }
}
