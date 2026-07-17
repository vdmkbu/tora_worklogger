<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Project\FormRequest\CreateRequest;
use App\Modules\Project\FormRequest\IndexRequest;
use App\Modules\Project\Models\Project;
use App\Modules\Project\Service\ProjectService;

class ProjectsController extends Controller
{
    public function __construct(
        private readonly ProjectService $projects,
    ) {}

    public function index(IndexRequest $request)
    {
        $projects = $this->projects->paginate($request->toDto());
        $statuses = Project::statusesList();

        return view('admin.projects.index', compact('projects', 'statuses'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(CreateRequest $request)
    {
        $this->projects->create($request->toDto());

        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project)
    {
        $statuses = Project::statusesList();

        return view('admin.projects.edit', compact('project', 'statuses'));
    }

    public function update(CreateRequest $request, Project $project)
    {
        $this->projects->update($project, $request->toDto());

        return redirect()->route('admin.projects.index');
    }

    public function switch(Project $project)
    {
        $this->projects->switchStatus($project);

        return redirect()->route('admin.projects.index');
    }
}
