<?php

declare(strict_types=1);

namespace Tests\Functional\Sesame\TimeTracking\Infrastructure\Api\ClockIn;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\Functional\BaseApiTestCase;
use Tests\Unit\Sesame\User\Domain\Entities\UserMother;
use Tests\Unit\Sesame\WorkEntry\Domain\Entities\WorkEntryMother;
use Tests\Utils\Factory\User\UserFactory;
use Tests\Utils\Factory\WorkEntry\WorkEntryFactory;
use Tests\Utils\Mother\MotherCreator;

final class ClockInControllerTest extends BaseApiTestCase
{
    private UserFactory $userFactory;
    private WorkEntryFactory $workEntryFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userFactory      = new UserFactory($this->factoryPersistence());
        $this->workEntryFactory = new WorkEntryFactory($this->factoryPersistence());
    }

    #[Test]
    public function itShouldClockInWorkEntry(): void
    {
        // GIVEN
        $userId      = MotherCreator::id();
        $userCreated = UserMother::random(['id' => $userId]);
        $this->userFactory->createOne($userCreated);

        $workEntryId = MotherCreator::id();
        $workEntry   = WorkEntryMother::create([
            'id'     => $workEntryId,
            'userId' => $userId,
        ]);
        $this->workEntryFactory->createOne($workEntry);

        $payload = [
            'startDate' => MotherCreator::dateTime()->format('Y-m-d H:i:s'),
        ];

        // WHEN
        $this->client()
            ->request(
                'PATCH',
                'api/work-entries/' . $workEntryId . '/clock-in',
                [],
                [],
                ['CONTENT_TYPE' => 'application/json'],
                json_encode($payload)
            );

        $this->client()->getResponse();

        // THEN
        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
