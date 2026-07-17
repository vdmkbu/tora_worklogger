<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Position\Service\PositionService;
use App\Modules\Project\Service\ProjectService;
use App\Modules\Report\FormRequest\PositionsReportRequest;
use App\Modules\Report\FormRequest\ProjectsReportRequest;
use App\Modules\Report\FormRequest\UsersReportRequest;
use App\Modules\Report\Service\ReportService;
use App\Modules\User\Service\UserService;

class ReportsController extends Controller
{
    public function __construct(
        private readonly ReportService $reports,
        private readonly ProjectService $projects,
        private readonly PositionService $positions,
        private readonly UserService $users,
    ) {}

    public function index()
    {
        return view('admin.reports.index');
    }

    public function projects(ProjectsReportRequest $request)
    {
        $filter = $request->toDto();

        $logs = $this->reports->projects($filter, $request->projectId());
        $interval = $filter->interval();
        $projects = $this->projects->ordered();

        return view('admin.reports.projects', compact('logs', 'projects', 'interval'));
    }

    public function positions(PositionsReportRequest $request)
    {
        $filter = $request->toDto();

        $logs = $this->reports->positions($filter, $request->positionId());
        $interval = $filter->interval();
        $positions = $this->positions->ordered();

        return view('admin.reports.positions', compact('logs', 'positions', 'interval'));
    }

    public function users(UsersReportRequest $request)
    {
        $filter = $request->toDto();

        $logs = $this->reports->users($filter, $request->userId());
        $interval = $filter->interval();
        $users = $this->users->activeOrdered();

        return view('admin.reports.users', compact('logs', 'interval', 'users'));
    }
}
