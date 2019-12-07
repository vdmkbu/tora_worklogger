<?php

namespace App\Http\Controllers;

use App\Http\Requests\Log\CreateRequest;
use App\Http\Requests\Log\UpdateRequest;
use App\Log;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class LogsController extends Controller
{
    public function index()
    {
        $users = User::all();

    }

    public function show(Request $request, $userId)
    {

        if (Gate::denies('log-owner', $userId)) {
            abort(403, 'Access denied');
        }


        $query = Log::with('project')->where('user_id', $userId);

        // если нет параметров, то выводим за текущий месяц
        if (empty($request->get('from_date')) && empty($request->get('to_date'))) {
            $query->where('date', 'LIKE', Carbon::now()->format('Y-m') . '-%');
        }

        // если выбран интервал
        if (!empty($from_date = $request->get('from_date')) && !empty($to_date = $request->get('to_date'))) {
            $query->where('date', '>=', $from_date)->where('date', '<=', $to_date);
        }

        if(!empty($from_date = $request->get('from_date')) && empty($request->get('to_date'))) {
            $query->where('date', '>=', $from_date);
        }

        if(empty($request->get('from_date')) && !empty($to_date = $request->get('to_date'))) {
            $query->where('date', '<=', $to_date);
        }

        if (!empty($value = $request->get('text'))) {
           $query->where('text','LIKE', '%' . $value . '%');
        }

        if (!empty($value = $request->get('project'))) {
            $query->where('project_id', $value);
        }


        $projects = Project::active()->orderBy('name','asc')->get();

        $time_total = $query->sum('time');
        $logs = $query->paginate(100);


        return view('log.show', compact('logs', 'userId', 'projects', 'time_total'));
    }

    public function create(User $user)
    {
        if (Gate::denies('log-owner', $user->id)) {
            abort(403, 'Access denied');
        }

        $projects = Project::active()->orderBy('name', 'asc')->get();
        $time_list  = Log::timeList();

        return view('log.create', compact('user', 'projects', 'time_list'));
    }

    public function store(CreateRequest $request, User $user)
    {
        if (Gate::denies('log-owner', $user->id)) {
            abort(403, 'Access denied');
        }

        Log::create([
           'user_id' => $user->id,
           'project_id' => $request->project_id,
           'text' => $request->text,
           'link' => $request->link,
           'time' => $request->time,
           'date' => $request->date
        ]);

        return redirect()->route('log.show', $user);
    }

    public function edit(User $user, Log $log)
    {
        if (Gate::denies('log-owner', $user->id)) {
            abort(403, 'Access denied');
        }

        $projects = Project::active()->get();
        $time_list  = Log::timeList();

        return view('log.edit', compact('user', 'log', 'projects', 'time_list'));
    }

    public function update(UpdateRequest $request, User $user, Log $log)
    {
        if (Gate::denies('log-owner', $user->id)) {
            abort(403, 'Access denied');
        }

        $log->update([
            'date' => $request->date,
            'project_id' => $request->project_id,
            'text' => $request->text,
            'link' => $request->link,
            'time' => $request->time
        ]);

        return redirect()->route('log.show', $user);
    }

    public function destroy($userId, Log $log)
    {
        if (Gate::denies('log-owner', $userId)) {
            abort(403, 'Access denied');
        }

        $log->delete();

        return redirect()->route('log.show', $userId);
    }


}
