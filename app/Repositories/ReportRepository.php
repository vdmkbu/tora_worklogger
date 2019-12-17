<?php

namespace App\Repositories;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    protected const TABLE = 'logs';

    public function projects(): Builder
    {
        $query = DB::table(self::TABLE)
                    ->select('projects.name as project')
                    ->selectRaw(DB::raw('SUM(time) as time'))
                    ->join('projects','logs.project_id','=','projects.id')
                    ->groupBy('project_id');

        return $query;
    }

    public function positions(): Builder
    {
        $query = DB::table(self::TABLE)
            ->select('positions.name as position')
            ->selectRaw(DB::raw('SUM(time) as time'))
            ->join('users', 'logs.user_id','=', 'users.id')
            ->join('positions','users.position_id','=','positions.id')
            ->groupBy('users.position_id');

        return $query;
    }

    public function users(): Builder
    {
        $query = DB::table(self::TABLE)
            ->select('users.name as user')
            ->selectRaw(DB::raw('SUM(time) as time'))
            ->join('users', 'logs.user_id','=', 'users.id')
            ->groupBy('users.id');

        return $query;
    }
}