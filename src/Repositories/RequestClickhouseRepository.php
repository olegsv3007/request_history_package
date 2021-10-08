<?php

namespace Olegsv\History\Repositories;


use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Olegsv\History\Models\Request;
use Olegsv\History\Services\PaginatorService;
use Tinderbox\Clickhouse\Client;

class RequestClickhouseRepository implements RequestRepositoryInterface
{
    public function get(array $filter = null): LengthAwarePaginator
    {
        $qb = Request::select([]);

        if (isset($filter['user_id'])) {
            $qb = $qb->where('user_id', $filter['user_id']);
        }

        if (isset($filter['ip'])) {
            $ip = ip2long($filter['ip']);
            $qb = $qb->where('ip', $ip);
        }

        if (isset($filter['url'])) {
            $qb = $qb->where('url', $filter['url']);
        }

        if (isset($filter['method'])) {
            $qb = $qb->where('method', $filter['method']);
        }

        if (isset($filter['code'])) {
            $qb = $qb->where('response_code', $filter['code']);
        }

        if (isset($filter['date_from']) && isset($filter['date_to'])) {
            $dateFrom = $this->addTimeToDate($filter['date_from']);
            $dateTo = $this->addTimeToDate($filter['date_to']);

            $qb = $qb->whereBetween(
                'created_at',
                [$dateFrom, $dateTo],
            );
        } else if (isset($filter['date_from'])) {

            $dateFrom = $this->addTimeToDate($filter['date_from']);
            $qb = $qb->where('created_at', '>', $dateFrom);

        } else if (isset($filter['date_to'])) {

            $dateTo = $this->addTimeToDate($filter['date_to']);
            $qb = $qb->where('created_at', '<', $dateTo);

        }

        $perPage = $filter['per_page'] ?? 50;
        $currentPage = $filter['page'] ?? null;
        $offset = $perPage * ($currentPage ? $currentPage - 1 : 0);
        $total = $qb->get()->count();
        $items = $qb->orderByDesc('created_at')
            ->limit($perPage, $offset)
            ->get();

        $paginator = (new LengthAwarePaginator(
            $items->rows(),
            $total,
            $perPage,
            $currentPage
        ))
            ->withPath(route('history.index'))
            ->withQueryString();

        return $paginator;
    }

    public function store(array $data): ?Request
    {
        return Request::create($data);
    }

    private function addTimeToDate(string $date): string
    {
        return $date . " 00:00:00";
    }
}
