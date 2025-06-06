<?php

declare(strict_types=1);

namespace App\Health\Application\Queries;

use App\Health\Application\Queries\Response\GetHealthQueryResponse;
use App\Health\Domain\HealthRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\QueryResponse;

final readonly class GetHealthQueryHandler implements QueryHandler
{
    public function __construct(
        private HealthRepository $healthRepository,
    ) {
    }

    public function __invoke(GetHealthQuery $query): QueryResponse
    {
        $health = $this->healthRepository->health();

        $status = $health->status();

        return GetHealthQueryResponse::create(
            $status ? 'OK' : 'FAIL',
            $status ? 'The application is healthy' : 'The application is not healthy'
        );
    }
}
