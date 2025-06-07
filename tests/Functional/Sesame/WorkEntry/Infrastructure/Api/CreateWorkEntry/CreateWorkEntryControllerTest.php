<?php

declare(strict_types=1);

namespace Functional\Sesame\WorkEntry\Infrastructure\Api\CreateWorkEntry;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\Functional\BaseApiTestCase;
use Tests\Utils\Mother\MotherCreator;

final class CreateWorkEntryControllerTest extends BaseApiTestCase
{
    #[Test]
    public function itShouldCreateWorkEntry(): void
    {
        // GIVEN
        $payload = [
            'id'        => MotherCreator::id(),
            'userId'    => MotherCreator::id(),
            'startDate' => MotherCreator::dateTime()->format('Y-m-d H:i:s'),
            'createdAt' => new \DateTimeImmutable()->format('Y-m-d H:i:s'),
        ];

        // WHEN
        $this->client()
            ->request(
                'POST',
                'api/work-entries',
                [],
                [],
                ['CONTENT_TYPE' => 'application/json'],
                json_encode($payload)
            );

        $this->client()->getResponse();

        // THEN
        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }
}
