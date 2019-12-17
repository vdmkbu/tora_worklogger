<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Position;
use App\Project;
use App\Repositories\ReportRepository;
use App\Services\FilterService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    protected $reportRepository;
    protected $filter;

    public function __construct(ReportRepository $repository, FilterService $filter)
    {
        $this->reportRepository = $repository;
        $this->filter = $filter;
    }

    public function index()
    {
        return view('admin.reports.index');
    }

    public function projects(Request $request)
    {

        $query = $this->reportRepository->projects();

        $result = $this->filter->filter($request, $query);

        if (!empty($value = $request->get('project'))) {
            $result->query->where('project_id', $value);
        }


        $logs = $result->query->get();
        $interval = $result->interval;

        $projects = Project::orderBy('name','asc')->get();

        return view('admin.reports.projects', compact('logs', 'projects', 'interval'));
    }

    public function positions(Request $request)
    {

        $query = $this->reportRepository->positions();

        $result = $this->filter->filter($request, $query);

        if (!empty($value = $request->get('position'))) {

            $result->query->where('users.position_id', $value);
        }

        $logs = $query->get();
        $interval = $result->interval;

        $positions = Position::orderBy('name', 'asc')->get();

        return view('admin.reports.positions', compact('logs', 'positions', 'interval'));
    }

    public function users(Request $request)
    {

        $query = $this->reportRepository->users();

        $result = $this->filter->filter($request, $query);

        if (!empty($value = $request->get('user'))) {

            $result->query->where('user_id', $value);
        }

        $logs = $query->get();
        $interval = $result->interval;

        $users = User::active()->orderBy('name', 'asc')->get();

        return view('admin.reports.users', compact('logs', 'interval', 'users'));
    }


}
