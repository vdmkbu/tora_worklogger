<?php

namespace App\Http\Controllers;

use App\Modules\Log\FormRequest\CreateRequest;
use App\Modules\Log\FormRequest\ShowRequest;
use App\Modules\Log\FormRequest\UpdateRequest;
use App\Modules\Log\Models\Log;
use App\Modules\Log\Service\LogService;
use App\Modules\Project\Service\ProjectService;
use App\Modules\User\Models\User;
use App\Modules\User\Service\UserService;
use Illuminate\Support\Facades\Gate;

class LogsController extends Controller
{
    public function __construct(
        private readonly LogService $logs,
        private readonly ProjectService $projects,
        private readonly UserService $users,
    ) {}

    public function index()
    {
        $users = $this->users->all();

        return view('log.index', compact('users'));
    }

    public function show(ShowRequest $request, $userId)
    {
        if (Gate::denies('log-owner', $userId)) {
            abort(403, 'Access denied');
        }

        $result = $this->logs->list($request->toDto((int) $userId));
        $logs = $result->logs;
        $time_total = $result->timeTotal;

        $projects = $this->projects->activeOrdered();

        return view('log.show', compact('logs', 'userId', 'projects', 'time_total'));
    }

    public function create(User $user)
    {
        if (Gate::denies('log-owner', $user->id)) {
            abort(403, 'Access denied');
        }

        $projects = $this->projects->activeOrdered();
        $time_list = Log::timeList();

        return view('log.create', compact('user', 'projects', 'time_list'));
    }

    public function store(CreateRequest $request, User $user)
    {
        if (Gate::denies('log-owner', $user->id)) {
            abort(403, 'Access denied');
        }

        $this->logs->create($user, $request->toDto());

        return redirect()->route('log.show', $user);
    }

    public function edit(User $user, Log $log)
    {
        if (Gate::denies('log-owner', $user->id)) {
            abort(403, 'Access denied');
        }

        $projects = $this->projects->activeOrdered();
        $time_list = Log::timeList();

        return view('log.edit', compact('user', 'log', 'projects', 'time_list'));
    }

    public function update(UpdateRequest $request, User $user, Log $log)
    {
        if (Gate::denies('log-owner', $user->id)) {
            abort(403, 'Access denied');
        }

        $this->logs->update($log, $request->toDto());

        return redirect()->route('log.show', $user);
    }

    public function destroy($userId, Log $log)
    {
        if (Gate::denies('log-owner', $userId)) {
            abort(403, 'Access denied');
        }

        $this->logs->delete($log);

        return redirect()->route('log.show', $userId);
    }
}
