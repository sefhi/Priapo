<?php

declare(strict_types=1);

namespace Tests\Unit\Sesame\User\Application\Queries\FindUserById;

use App\Sesame\User\Application\Queries\FindUserById\FindUserByIdHandler;
use App\Sesame\User\Application\Queries\FindUserById\FindUserByIdQuery;
use App\Sesame\User\Application\Queries\FindUserById\UserResponse;
use App\Sesame\User\Domain\Exceptions\UserNotFoundException;
use App\Sesame\User\Domain\Repositories\UserFindRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Sesame\User\Domain\Entities\UserMother;
use Tests\Utils\Mother\MotherCreator;

final class FindUserByIdHandlerTest extends TestCase
{
    private UserFindRepository|MockObject $userRepository;
    private FindUserByIdHandler $handler;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserFindRepository::class);
        $this->handler        = new FindUserByIdHandler($this->userRepository);
    }

    #[Test]
    public function itShouldFindUserById(): void
    {
        // GIVEN

        $userId               = MotherCreator::id();
        $userFind             = UserMother::random(['id' => $userId]);
        $userResponseExpected = UserResponse::fromUser($userFind);
        $query                = new FindUserByIdQuery($userId);

        // WHEN

        $this->userRepository
            ->expects(self::once())
            ->method('findById')
            ->with($userId)
            ->willReturn($userFind);

        $result = ($this->handler)($query);

        // THEN

        self::assertInstanceOf(UserResponse::class, $result);
        self::assertEquals($userResponseExpected, $result);
    }

    #[Test]
    public function itShouldThrownAnUserNotFoundExceptionWhenNotFoundUser(): void
    {
        // GIVEN
        $userId = MotherCreator::id();
        $query  = new FindUserByIdQuery($userId);

        // WHEN

        $this->userRepository
            ->expects(self::once())
            ->method('findById')
            ->with($userId)
            ->willReturn(null);

        // THEN

        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage('User with id ' . $userId . ' not found');

        ($this->handler)($query);
    }
}
