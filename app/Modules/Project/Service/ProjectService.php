<?php

namespace App\Modules\Project\Service;

use App\Modules\Project\Dto\ProjectData;
use App\Modules\Project\Dto\ProjectFilterData;
use App\Modules\Project\Factory\ProjectFactory;
use App\Modules\Project\Models\Project;
use App\Modules\Project\Repository\ProjectRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function __construct(
        private readonly ProjectRepository $repository,
        private readonly ProjectFactory $factory,
    ) {}

    public function paginate(ProjectFilterData $filter): LengthAwarePaginator
    {
        return $this->repository->paginateFiltered($filter);
    }

    public function activeOrdered(): Collection
    {
        return $this->repository->activeOrdered();
    }

    public function ordered(): Collection
    {
        return $this->repository->ordered();
    }

    public function create(ProjectData $data): Project
    {
        $project = $this->factory->make($data);
        $this->repository->save($project);

        return $project;
    }

    public function update(Project $project, ProjectData $data): void
    {
        $project->fill(['name' => $data->name]);
        $this->repository->save($project);
    }

    public function switchStatus(Project $project): void
    {
        $project->switchStatus();
        $this->repository->save($project);
    }
}
