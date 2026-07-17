<?php

namespace App\Modules\Position\Service;

use App\Modules\Position\Dto\PositionData;
use App\Modules\Position\Dto\PositionFilterData;
use App\Modules\Position\Factory\PositionFactory;
use App\Modules\Position\Models\Position;
use App\Modules\Position\Repository\PositionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PositionService
{
    public function __construct(
        private readonly PositionRepository $repository,
        private readonly PositionFactory $factory,
    ) {}

    public function paginate(PositionFilterData $filter): LengthAwarePaginator
    {
        return $this->repository->paginateFiltered($filter);
    }

    public function activeList(): Collection
    {
        return $this->repository->activeList();
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function ordered(): Collection
    {
        return $this->repository->ordered();
    }

    public function create(PositionData $data): Position
    {
        $position = $this->factory->make($data);
        $this->repository->save($position);

        return $position;
    }

    public function update(Position $position, PositionData $data): void
    {
        $position->fill(['name' => $data->name]);
        $this->repository->save($position);
    }

    public function switchStatus(Position $position): void
    {
        $position->switchStatus();
        $this->repository->save($position);
    }
}
