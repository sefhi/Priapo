<?php

declare(strict_types=1);

namespace Functional\Sesame\User\Infrastructure\Api\CreateUser;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\Functional\BaseApiTestCase;
use Tests\Utils\MotherCreator;

final class CreateUserControllerTest extends BaseApiTestCase
{
    #[Test]
    public function itShouldCreateUser(): void
    {
        // GIVEN

        $payload = [
            'id'        => MotherCreator::id(),
            'name'      => MotherCreator::name(),
            'email'     => MotherCreator::email(),
            'password'  => MotherCreator::password(),
            'createdAt' => MotherCreator::dateTime(),
        ];

        // WHEN

        $this->client()
            ->request(
                'POST',
                'api/users',
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
