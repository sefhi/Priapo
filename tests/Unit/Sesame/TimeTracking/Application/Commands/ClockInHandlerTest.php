<?php

declare(strict_types=1);

namespace Tests\Unit\Sesame\TimeTracking\Application\Commands;

use App\Sesame\TimeTracking\Application\Commands\ClockIn\ClockInCommand;
use App\Sesame\TimeTracking\Application\Commands\ClockIn\ClockInHandler;
use App\Sesame\WorkEntry\Domain\Entities\WorkEntry;
use App\Sesame\WorkEntry\Domain\Repositories\WorkEntrySaveRepository;
use App\Sesame\WorkEntry\Domain\Services\EnsureExistWorkEntryByIdService;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Unit\Sesame\WorkEntry\Domain\Entities\WorkEntryMother;
use Tests\Utils\Mother\MotherCreator;

final class ClockInHandlerTest extends TestCase
{
    private WorkEntrySaveRepository|MockObject $workEntrySaveRepository;
    private EnsureExistWorkEntryByIdService|MockObject $ensureExistsWorkEntryByIdService;

    protected function setUp(): void
    {
        $this->workEntrySaveRepository          = $this->createMock(WorkEntrySaveRepository::class);
        $this->ensureExistsWorkEntryByIdService = $this->createMock(EnsureExistWorkEntryByIdService::class);

        $this->handler = new ClockInHandler(
            $this->workEntrySaveRepository,
            $this->ensureExistsWorkEntryByIdService,
        );
    }

    #[Test]
    public function itShouldClockIn(): void
    {
        // GIVEN

        $workEntryId = Uuid::fromString(MotherCreator::id());
        $command     = new ClockInCommand(
            workEntryId: $workEntryId->toString(),
            startDate: new \DateTimeImmutable(),
        );

        $workEntryFind = WorkEntryMother::create(['id' => $workEntryId->toString()]);

        // WHEN

        $this->ensureExistsWorkEntryByIdService
            ->expects(self::once())
            ->method('__invoke')
            ->with($workEntryId)
            ->willReturn($workEntryFind);

        $this->workEntrySaveRepository
            ->expects(self::once())
            ->method('save')
            ->with(
                self::callback(
                    fn (WorkEntry $workEntry) => $workEntry->isClockedIn()
                )
            );

        // THEN

        ($this->handler)($command);
    }
}
