<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Projects\CreateRequest;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::orderBy('name','asc');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        $statuses = Project::statusesList();
        $projects = $query->paginate(20);

        return view('admin.projects.index', compact('projects', 'statuses'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(CreateRequest $request)
    {
        Project::create([
            'name' => $request->name,
            'status' => Project::STATUS_ACTIVE
        ]);

        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project)
    {
        $statuses = Project::statusesList();
        return view('admin.projects.edit', compact('project', 'statuses'));
    }

    public function update(CreateRequest $request, Project $project)
    {
        $project->update($request->only(['name']));

        return redirect()->route('admin.projects.index');
    }

    public function switch(Project $project)
    {
        $project->switchStatus();
        return redirect()->route('admin.projects.index');
    }
}
