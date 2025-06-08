<?php

declare(strict_types=1);

namespace App\Sesame\User\Infrastructure\Api\Me;

use App\Sesame\User\Application\Queries\Me\GetUserMeQuery;
use App\Shared\Api\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class MeController extends BaseController
{
    public function __invoke(): Response
    {
        return new JsonResponse($this->query(new GetUserMeQuery()));
    }

    protected function exceptions(): array
    {
        return [];
    }
}
