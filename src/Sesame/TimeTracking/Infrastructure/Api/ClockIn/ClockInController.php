<?php

declare(strict_types=1);

namespace App\Sesame\TimeTracking\Infrastructure\Api\ClockIn;

use App\Sesame\TimeTracking\Domain\Exceptions\WorkEntryAlreadyClockedInException;
use App\Sesame\TimeTracking\Domain\Exceptions\WorkEntryAlreadyClockedOutException;
use App\Sesame\WorkEntry\Domain\Exceptions\WorkEntryNotFoundException;
use App\Shared\Api\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class ClockInController extends BaseController
{
    public function __invoke(
        string $id,
        #[MapRequestPayload] ClockInRequest $request,
    ): Response {
        $this->commandBus->command(command: $request->toClockInCommand(workEntryId: $id));

        return new Response(status: Response::HTTP_OK);
    }

    protected function exceptions(): array
    {
        return [
            WorkEntryNotFoundException::class          => Response::HTTP_NOT_FOUND,
            WorkEntryAlreadyClockedInException::class  => Response::HTTP_BAD_REQUEST,
            WorkEntryAlreadyClockedOutException::class => Response::HTTP_BAD_REQUEST,
        ];
    }
}
