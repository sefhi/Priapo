<?php

declare(strict_types=1);

namespace App\Sesame\TimeTracking\Infrastructure\Api\ClockIn;

use App\Sesame\TimeTracking\Application\Commands\ClockIn\ClockInCommand;

final class ClockInRequest
{
    public function __construct(
        public ?string $startDate = null,
    ) {
    }

    public function toClockInCommand(string $workEntryId): ClockInCommand
    {
        return new ClockInCommand(
            $workEntryId,
            $this->startDate ? new \DateTimeImmutable($this->startDate) : null,
        );
    }
}
