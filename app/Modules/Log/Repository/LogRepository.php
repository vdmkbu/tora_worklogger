<?php

namespace App\Modules\Log\Repository;

use App\Modules\Log\Dto\LogFilterData;
use App\Modules\Log\Models\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class LogRepository
{
    public function paginateForUser(LogFilterData $filter, int $perPage = 100): LengthAwarePaginator
    {
        return $this->filtered($filter)->paginate($perPage);
    }

    public function sumTimeForUser(LogFilterData $filter): float
    {
        return (float) $this->filtered($filter)->sum('time');
    }

    public function save(Log $log): void
    {
        $log->save();
    }

    public function delete(Log $log): void
    {
        $log->delete();
    }

    private function filtered(LogFilterData $filter): Builder
    {
        $query = Log::with('project')->where('user_id', $filter->userId);

        // no interval selected -> current month
        if (empty($filter->fromDate) && empty($filter->toDate)) {
            $query->where('date', 'LIKE', Carbon::now()->format('Y-m').'-%');
        }

        if (! empty($filter->fromDate)) {
            $query->where('date', '>=', $filter->fromDate);
        }

        if (! empty($filter->toDate)) {
            $query->where('date', '<=', $filter->toDate);
        }

        if (! empty($filter->text)) {
            $query->where('text', 'LIKE', '%'.$filter->text.'%');
        }

        if ($filter->projectId !== null) {
            $query->where('project_id', $filter->projectId);
        }

        return $query;
    }
}
