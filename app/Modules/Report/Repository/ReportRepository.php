<?php

namespace App\Modules\Report\Repository;

use App\Modules\Report\Dto\DateFilterData;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    protected const TABLE = 'logs';

    public function projectsReport(DateFilterData $filter, ?int $projectId = null): Collection
    {
        $query = DB::table(self::TABLE)
            ->select('projects.name as project')
            ->selectRaw('SUM(time) as time')
            ->join('projects', 'logs.project_id', '=', 'projects.id')
            ->groupBy('project_id');

        $this->applyDateFilter($query, $filter);

        if ($projectId !== null) {
            $query->where('project_id', $projectId);
        }

        return $query->get();
    }

    public function positionsReport(DateFilterData $filter, ?int $positionId = null): Collection
    {
        $query = DB::table(self::TABLE)
            ->select('positions.name as position')
            ->selectRaw('SUM(time) as time')
            ->join('users', 'logs.user_id', '=', 'users.id')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->groupBy('users.position_id');

        $this->applyDateFilter($query, $filter);

        if ($positionId !== null) {
            $query->where('users.position_id', $positionId);
        }

        return $query->get();
    }

    public function usersReport(DateFilterData $filter, ?int $userId = null): Collection
    {
        $query = DB::table(self::TABLE)
            ->select('users.name as user')
            ->selectRaw('SUM(time) as time')
            ->join('users', 'logs.user_id', '=', 'users.id')
            ->groupBy('users.id');

        $this->applyDateFilter($query, $filter);

        if ($userId !== null) {
            $query->where('user_id', $userId);
        }

        return $query->get();
    }

    private function applyDateFilter(Builder $query, DateFilterData $filter): void
    {
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
    }
}
