<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Log;
use App\Position;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function projects(Request $request)
    {
        $query = DB::table('logs')
            ->select('projects.name as project')
            ->selectRaw(DB::raw('SUM(time) as time'))
            ->join('projects','logs.project_id','=','projects.id')
            ->groupBy('project_id');

        // если нет параметров, то выводим за текущий месяц
        if (empty($request->get('from_date')) && empty($request->get('to_date'))) {
            $query->where('date', 'LIKE', Carbon::now()->format('Y-m') . '-%');


            $interval = [
                'start' => (new Carbon('first day of this month'))->format('Y.m.d'),
                'end' => (new Carbon('last day of this month'))->format('Y.m.d')
            ];


        }

        // если выбран интервал
        if (!empty($from_date = $request->get('from_date')) && !empty($to_date = $request->get('to_date'))) {
            $query->where('date', '>=', $from_date)->where('date', '<=', $to_date);

            $interval = [
                'start' => (new Carbon($from_date))->format('Y.m.d'),
                'end' => (new Carbon($to_date))->format('Y.m.d')
            ];
        }

        if(!empty($from_date = $request->get('from_date')) && empty($request->get('to_date'))) {
            $query->where('date', '>=', $from_date);

            $interval = [
                'start' => (new Carbon($from_date))->format('Y.m.d'),
                'end' => (new Carbon())->format('Y.m.d')
            ];
        }

        if(empty($request->get('from_date')) && !empty($to_date = $request->get('to_date'))) {
            $query->where('date', '<=', $to_date);

            $interval = [
                'start' => '',
                'end' => (new Carbon($to_date))->format('Y.m.d')
            ];
        }

        if (!empty($value = $request->get('project'))) {
            $query->where('project_id', $value);
        }




        $logs = $query->get();

        $projects = Project::orderBy('name','asc')->get();

        return view('admin.reports.projects', compact('logs', 'projects', 'interval'));
    }

    public function positions(Request $request)
    {

        $query = DB::table('logs')
            ->select('positions.name as position')
            ->selectRaw(DB::raw('SUM(time) as time'))
            ->join('users', 'logs.user_id','=', 'users.id')
            ->join('positions','users.position_id','=','positions.id')
            ->groupBy('users.position_id');


        // если нет параметров, то выводим за текущий месяц
        if (empty($request->get('from_date')) && empty($request->get('to_date'))) {
            $query->where('date', 'LIKE', Carbon::now()->format('Y-m') . '-%');


            $interval = [
                'start' => (new Carbon('first day of this month'))->format('Y.m.d'),
                'end' => (new Carbon('last day of this month'))->format('Y.m.d')
            ];


        }

        // если выбран интервал
        if (!empty($from_date = $request->get('from_date')) && !empty($to_date = $request->get('to_date'))) {
            $query->where('date', '>=', $from_date)->where('date', '<=', $to_date);

            $interval = [
                'start' => (new Carbon($from_date))->format('Y.m.d'),
                'end' => (new Carbon($to_date))->format('Y.m.d')
            ];
        }

        if(!empty($from_date = $request->get('from_date')) && empty($request->get('to_date'))) {
            $query->where('date', '>=', $from_date);

            $interval = [
                'start' => (new Carbon($from_date))->format('Y.m.d'),
                'end' => (new Carbon())->format('Y.m.d')
            ];
        }

        if(empty($request->get('from_date')) && !empty($to_date = $request->get('to_date'))) {
            $query->where('date', '<=', $to_date);

            $interval = [
                'start' => '',
                'end' => (new Carbon($to_date))->format('Y.m.d')
            ];
        }

        if (!empty($value = $request->get('position'))) {

            $query->where('users.position_id', $value);
        }

        $logs = $query->get();

        $positions = Position::orderBy('name', 'asc')->get();

        return view('admin.reports.positions', compact('logs', 'positions', 'interval'));
    }


}
