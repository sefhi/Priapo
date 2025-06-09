<?php

declare(strict_types=1);

namespace App\Sesame\WorkEntry\Infrastructure\Api\ListWorkEntry;

use App\Sesame\User\Domain\Security\AuthenticatedUserProvider;
use App\Sesame\WorkEntry\Application\Queries\ListWorkEntry\ListWorkEntryQuery;
use App\Shared\Api\BaseController;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Infrastructure\Exceptions\SymfonyExceptionsHttpStatusCodeMapping;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ListWorkEntryController extends BaseController
{
    public function __construct(
        SymfonyExceptionsHttpStatusCodeMapping $exceptionMapping,
        CommandBus $commandBus,
        QueryBus $queryBus,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        private readonly AuthenticatedUserProvider $authenticatedUserProvider,
    ) {
        parent::__construct($exceptionMapping, $commandBus, $queryBus, $serializer, $validator);
    }

    public function __invoke(): Response
    {
        $user = $this->authenticatedUserProvider->currentUser();

        $workEntriesResponse = $this->query(
            new ListWorkEntryQuery(
                $user->id()->toString(),
            )
        );

        return new JsonResponse($workEntriesResponse, Response::HTTP_OK);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
