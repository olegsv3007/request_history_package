<?php

namespace Olegsv\History\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Olegsv\History\Models\Request;
use Olegsv\History\Repositories\RequestRepositoryInterface;

class RequestService
{

    public function __construct(
        private RequestRepositoryInterface $repository,
    ) {}

    public function get(array $filter = null): LengthAwarePaginator
    {
        return $this->repository->get($filter);
    }
}
