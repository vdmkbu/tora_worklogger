<?php

namespace App\Http\Controllers;

use App\Log;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LogsController extends Controller
{
    public function index()
    {
        echo '1';
    }

    public function show(Request $request, User $user)
    {
        $query = Log::with('project')->where('user_id', $user->id);

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
           $query->where('text','LIKE', $value);
        }

        if (!empty($value = $request->get('project'))) {
            $query->where('project_id', $value);
        }





        $projects = Project::active()->orderBy('name','asc')->get();

        $logs = $query->paginate(100);

            //->where('date', Carbon::now()->format('Y-m-d'))->get();

        return view('log.show', compact('logs', 'user', 'projects'));
    }

    public function create(User $user)
    {
        $projects = Project::active()->orderBy('name', 'asc')->get();
        $time_list  = Log::timeList();

        return view('log.create', compact('user', 'projects', 'time_list'));
    }

    public function store(Request $request, User $user)
    {
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
        $projects = Project::active()->get();
        $time_list  = Log::timeList();

        return view('log.edit', compact('user', 'log', 'projects', 'time_list'));
    }

    public function update(Request $request, User $user, Log $log)
    {
        $log->update([
            'date' => $request->date,
            'project_id' => $request->project_id,
            'text' => $request->text,
            'link' => $request->link,
            'time' => $request->time
        ]);

        return redirect()->route('log.show', $user);
    }

    public function destroy(User $user, Log $log)
    {
        $log->delete();

        return redirect()->route('log.show', $user);
    }


}
