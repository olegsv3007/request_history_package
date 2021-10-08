<?php

namespace Olegsv\History\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Olegsv\History\Models\Request;

interface RequestRepositoryInterface
{
    public function get(): LengthAwarePaginator;

}
