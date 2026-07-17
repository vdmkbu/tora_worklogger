<?php

namespace App\Modules\Project\Repository;

use App\Modules\Project\Dto\ProjectFilterData;
use App\Modules\Project\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository
{
    public function paginateFiltered(ProjectFilterData $filter, int $perPage = 20): LengthAwarePaginator
    {
        $query = Project::query()->orderBy('status', 'asc')->orderBy('name', 'asc');

        if ($filter->id !== null) {
            $query->where('id', $filter->id);
        }
        if ($filter->name !== null) {
            $query->where('name', 'like', '%'.$filter->name.'%');
        }
        if ($filter->status !== null) {
            $query->where('status', $filter->status);
        }

        return $query->paginate($perPage);
    }

    public function activeOrdered(): Collection
    {
        return Project::active()->orderBy('name', 'asc')->get();
    }

    public function ordered(): Collection
    {
        return Project::query()->orderBy('name', 'asc')->get();
    }

    public function save(Project $project): void
    {
        $project->save();
    }
}
