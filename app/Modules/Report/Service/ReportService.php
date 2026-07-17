<?php

namespace App\Modules\Report\Service;

use App\Modules\Report\Dto\DateFilterData;
use App\Modules\Report\Repository\ReportRepository;
use Illuminate\Support\Collection;

readonly class ReportService
{
    public function __construct(
        private ReportRepository $repository,
    ) {}

    public function projects(DateFilterData $filter, ?int $projectId = null): Collection
    {
        return $this->repository->projectsReport($filter, $projectId);
    }

    public function positions(DateFilterData $filter, ?int $positionId = null): Collection
    {
        return $this->repository->positionsReport($filter, $positionId);
    }

    public function users(DateFilterData $filter, ?int $userId = null): Collection
    {
        return $this->repository->usersReport($filter, $userId);
    }
}
