<?php

declare(strict_types=1);

namespace App\Health\Application\Queries\Response;

use App\Shared\Domain\Bus\Query\QueryResponse;

final readonly class GetHealthQueryResponse implements QueryResponse, \JsonSerializable
{
    private function __construct(
        private string $status,
        private string $message,
    ) {
    }

    public static function create(
        string $status,
        string $message,
    ): self {
        return new self($status, $message);
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
