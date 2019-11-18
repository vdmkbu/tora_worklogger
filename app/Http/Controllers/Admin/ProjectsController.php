<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Projects\CreateRequest;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $query = Project::orderBy('name','asc');

        $projects = $query->paginate(20);

        return view('admin.projects.index', compact('projects'));
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
